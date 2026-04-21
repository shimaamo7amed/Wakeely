<?php

namespace Modules\Client\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Client\Entities\Model as Client;
use Modules\Client\Http\Requests\ForgetPasswordRequest;
use Modules\Client\Http\Requests\LoginRequest;
use Modules\Client\Http\Requests\RegisterRequest;
use Modules\Client\Http\Requests\ResetPasswordRequest;
use Modules\Client\Http\Requests\UpdateImageRequest;
use Modules\Client\Http\Requests\UpdatePassRequest;
use Modules\Client\Http\Requests\UpdateProfileRequest;
use Modules\Client\Http\Requests\VerifyForgetOtpRequest;
use Modules\Client\Http\Requests\VerifyRegisterRequest;
use Modules\Client\Http\Resources\ClientResource;
use Modules\Client\Http\Resources\LegalProfileResource;
use Modules\Client\Http\Resources\ProfileResource;
use Modules\Client\Services\AuthServices;
use Modules\Country\Entities\Model as Country;

class APIController extends BasicController
{
    protected $authService;

    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }
    public function Login(LoginRequest $request)
    {
        $data = $request->validated();

        $Model = Client::where('email', $data['email'])
            ->where('is_email_verified', 1)
            ->first();

        if (!$Model) {
            return ResponseHelper::make(null, __('client::messages.invalidEmail'), false);
        }

        if (!Hash::check($data['password'], $Model->password)) {
            return ResponseHelper::make(null, __('client::messages.invalidPassword'), false);
        }

        $response = [
            'token' => $Model->createToken('ClientToken')->plainTextToken,
            'client' => ClientResource::make($Model),
        ];

        return ResponseHelper::make($response, __('client::messages.loginSuccessfully'));
    }

    public function register(RegisterRequest $request)
    {
        $this->authService->sendOtp($request->validated());

        return ResponseHelper::make(
            null,
            __('client::messages.otp_sent_successfully')
        );
    }
    public function verifyOtp(VerifyRegisterRequest $request)
    {
        $result = $this->authService->verifyOTP($request->validated());

        if (!$result['success']) {
            return ResponseHelper::make(null, __('client::messages.invalid_otp'), 422);
        }

        $client = $result['client'];

        return ResponseHelper::make([
            'token'  => $client->createToken('ClientToken')->plainTextToken,
            'client' => new ClientResource($client),
        ], __('client::messages.verified_successfully'));
    }
    public function logout(Request $request)
    {
        $client = $this->AuthClient();
        // dd($client);

        if (!$client) {
            return ResponseHelper::make(null, __('client::messages.unauthorized'), false);
        }

        $request->user()->currentAccessToken()->delete();

        return ResponseHelper::make(null, __('client::messages.logout_successfully'));
    }
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $this->authService->forgetPassword($request->validated());
        return ResponseHelper::make(null, __('client::messages.otp_sent_successfully'));
    }
    public function verifyForgetPasswordOtp(VerifyForgetOtpRequest $request)
    {
        // dd($request);
        $result = $this->authService->verifyForgetOtp($request->validated());
        if (!$result) {
            return ResponseHelper::make(null, __('client::messages.invalid_otp'), 422);
        }
        return ResponseHelper::make(null, __('client::messages.otp_verified_successfully'));
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        $client = $this->authService->resetPassword($request->validated());
    
        if (!$client) {
            return ResponseHelper::make(null, __('client::messages.invalid_otp'), 400);
        }
    
        return ResponseHelper::make([
            'token'  => $client->createToken('ClientToken')->plainTextToken,
            'client' => new ClientResource($client),
        ], __('client::messages.password_reset_successfully'));
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $client = $this->AuthClient();
        $newData = $request->validated();

        if ($request->email !== $client->email) {
            // $otp = rand(100000, 999999); 
            $otp=123456;
            cache()->put('pending_email_update_' . $client->id, [
                'email'      => $request->email,
                'otp'        => $otp,
                'other_data' => $request->only(['first_name', 'last_name', 'phone']) 
            ], now()->addMinutes(15));
            Mail::send('mails.verify-email-update', [
                'otp'  => $otp,
                'name' => $request->first_name,
            ], function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Your OTP Verification Code');
            });

            return ResponseHelper::make(null, __('client::messages.otp_sent_successfully'));
        }
        $client->update($newData);
        return ResponseHelper::make(ClientResource::make($client), __('client::messages.updatedSuccessfully'));
    }

    public function verifyEmailUpdate(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);
        $client = $this->AuthClient();
        $cacheKey = 'pending_email_update_' . $client->id;
        $cachedData = cache()->get($cacheKey);

        if ($cachedData && $cachedData['otp'] == $request->otp) {
                $client->update(array_merge(
                ['email' => $cachedData['email']],
                $cachedData['other_data']
            ));
            cache()->forget($cacheKey);

            return ResponseHelper::make(ClientResource::make($client), __('client::messages.updatedSuccessfully'));
        }

        return ResponseHelper::make(null, __('client::messages.invalid_otp'), 422);
    }

    public function updateImage(UpdateImageRequest $request)
    {
        $client = $this->AuthClient();

        if (!$client) {
            return ResponseHelper::make(null, __('client::messages.unauthorized'), false);
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = Upload::uploadFile($request->file('image'), 'clients');
            $client->update(['image' => $image]);
        }

        return ResponseHelper::make(
            ClientResource::make($client),
            __('client::messages.image_updated_successfully')
        );
    }

    public function updatePassword(UpdatePassRequest $request)
    {
        $client = $this->AuthClient();

        if (!$client) {
            return ResponseHelper::make(null, __('client::messages.unauthorized'), false);
        }
        $data = $request->validated();
        $client->update(['password' => $data['password']]);
        return ResponseHelper::make(null, __('client::messages.password_updated_successfully'));
    }
    public function profile(Request $request)
    {
        $client = $this->AuthClient();

        if (!$client) {
            return ResponseHelper::make(null, __('client::messages.unauthorized'), false);
        }

        return ResponseHelper::make(ClientResource::make($client));
    }


    public function AuthClient()
    {
        return auth('client')->user();

    }
    public function updateToken(Request $request)
    {
        $client = $this->AuthClient();
        if (!$client) {
            return ResponseHelper::make(null, __('trans.unauthenticated'), 401);
        }
        $request->validate([
            'device_token' => 'nullable|string',
            'device_type' => 'nullable|in:android,ios'
        ]);
        $client->DeviceTokens()->updateOrCreate(
            [
                'device_token' => $request->device_token,
            ],
            [
                'device_type' => $request->device_type,
            ]
        );


        $response = [
            'token' => $client->createToken('ClientToken')->plainTextToken,
            'type' => 'client',
            'client' => ClientResource::make($client),
        ];

        return ResponseHelper::make($response, __('client::messages.updatedSuccessfully'));
    }

    public function personalInfo()
    {
        $user = $this->AuthClient();
        return ResponseHelper::make(ProfileResource::make($user));
    }

    public function legalInfo()
    {
        $user = $this->AuthClient();

        if ($user->type !== 'lawyer') {
            return ResponseHelper::make(null, __('client::messages.unauthorized'), false);
        }

        $user->load([
            'legalProfile.workAreas',
            'legalProfile.expertises',
            'legalProfile.languages',
            'legalProfile.qualifications.degreeType',
            'legalProfile.qualifications.university',
            'legalProfile.year_of_experiance',
        ]);

        return ResponseHelper::make(LegalProfileResource::make($user->legalProfile));
    }

    public function userAuth()
    {
        $client = $this->AuthClient();
        if (!$client) {
            return ResponseHelper::make(null, __('trans.unauthenticated'), 401);
        }
        return ResponseHelper::make(ClientResource::make($client));
    }


}