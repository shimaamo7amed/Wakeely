<?php

namespace Modules\Client\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Modules\Client\Entities\Model as Client;

class AuthServices
{
    public function sendOtp(array $data)
    {
        // $otp = rand(100000, 999999);
        $otp = 123456;

        $key = 'register_' . $data['email']; 

        Cache::put($key, [
            'data' => $data,
            'otp'  => $otp
        ], now()->addMinutes(10));

        Mail::send('mails.client-otp', [
            'otp'  => $otp,
            'name' => $data['first_name'],
        ], function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Your OTP Verification Code');
        });

        return $otp;
    }

    public function verifyOTP(array $data)
    {
        $key = 'register_' . $data['email'];

        $cached = Cache::get($key);

        if (!$cached) {
            return ['success' => false, 'message' => 'OTP expired or not found'];
        }
        if ((int)$cached['otp'] !== (int)$data['otp']) {
            return ['success' => false, 'message' => 'Invalid OTP'];
        }

        $userData = $cached['data'];
        
        $statusMap = [
            'user'   => 'active',
            'lawyer' => 'incomplete',
        ];

        $userData['status'] = $statusMap[$userData['type']] ?? 'inactive';
        $userData['is_email_verified'] = 1;
        $client = Client::create($userData);

        return ['success' => true, 'client' => $client];
    }

    public function forgetPassword(array $data)
    {
        $client = Client::where('email', $data['email'])->first();

        if (!$client) {
            return false;
        }
        // $otp= rand(100000, 999999);
        $otp=123456;
        Cache::put(
            'otp_'.$client->email,
            $otp,
            now()->addMinutes(10)
        );

        Mail::send('mails.forget-password', [
            'client' => $client,
            'otp'    => $otp,
        ], function ($message) use ($client) {
            $message->to($client->email)
                ->subject('Forget Password');
        });

        return true;
    }

    public function verifyForgetOtp(array $data)
    {
        $client = Client::where('email', $data['email'])->first();

        if (!$client) {
            return false;
        }
        $cachedOtp = Cache::get('otp_'.$client->email);

        if (!$cachedOtp) {
            return false;
        }

        if ($cachedOtp != $data['otp']) {
            return false; 
        }
        Cache::put('otp_verified_'.$client->email, true, now()->addMinutes(10));

        return true;
    }

    public function resetPassword(array $data)
    {
        $client = Client::where('email', $data['email'])->first();

        if (!$client) {
            return false;
        }
        $verified = Cache::get('otp_verified_'.$client->email);

        if (!$verified) {
            return false;
        }

        $client->update([
            'password' =>$data['password'],
        ]);

        Cache::forget('otp_'.$client->email);
        Cache::forget('otp_verified_'.$client->email);

        return true;
    }

}

