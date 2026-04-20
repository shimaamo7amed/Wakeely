<?php
namespace Modules\Lawyer\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Carbon\Carbon;
use Modules\Lawyer\Http\Requests\PublicUpdateLegalRequest;
use Modules\Lawyer\Http\Requests\UpdateExpertisesRequest;
use Modules\Lawyer\Http\Requests\UpdateWorkAreasRequest;

class PublicController extends BasicController
{
    public function updateLegalInfo(PublicUpdateLegalRequest $request)
    {
        $lawyer = $this->ClientAuth();
        if (!$lawyer || $lawyer->type !== 'lawyer' || $lawyer->status !== 'accepted') {
            return ResponseHelper::make(null, __('lawyer::messages.update_failed'), 403);
        }
        $profile = $lawyer->legalProfile;
        if (!$profile) {
            return ResponseHelper::make(null, __('lawyer::messages.update_failed'), 404);
        }
        $profile->fill([
            'consultation_price' => $request->consultation_price,
            'summary'            => $request->summary,
            'experience_id'      => $request->experience_id,
        ]);

        if (!$profile->save()) {
            return ResponseHelper::make(null, __('lawyer::messages.update_failed'), 500);
        }

        $profile->languages()->sync($request->input('languages'));

        return ResponseHelper::make(null, __('lawyer::messages.update_success'));
    }


    public function updateWorkAreas(UpdateWorkAreasRequest $request)
    {
        $lawyer = $this->ClientAuth();
        if (!$lawyer || $lawyer->type !== 'lawyer' || $lawyer->status !== 'accepted') {
            return ResponseHelper::make(null, __('lawyer::messages.update_failed'), 403);
        }

        $profile = $lawyer->legalProfile;
        $wallet = $lawyer->tokenWallet;

        if (!$profile) {
            return ResponseHelper::make(null, __('lawyer::messages.profile_not_found'), 404);
        }
        $requestedAreas = $request->input('work_areas', []);
        $newCount = count($requestedAreas);
        $currentCount = $profile->workAreas()->count();
        $freeLimit = 2;  
        $costPerExtra = 2;
        $requiredTokens = 0;
        if ($newCount > $currentCount && $newCount > $freeLimit) {
            $baseCount = max($currentCount, $freeLimit);
            $extraAreas = $newCount - $baseCount;
            $requiredTokens = $extraAreas * $costPerExtra;
        }
        if ($requiredTokens > 0) {
            if (!$wallet) {
                return ResponseHelper::make(null, __('lawyer::messages.insufficient_tokens'), 400);
            }
            $isFreeExpired = $wallet->free_expires_at && now()->greaterThan($wallet->free_expires_at);
            $availableFree = $isFreeExpired ? 0 : $wallet->free_balance;
            
            $totalAvailable = $wallet->balance + $availableFree;
            if ($totalAvailable < $requiredTokens) {
                return ResponseHelper::make(null, __('lawyer::messages.insufficient_tokens'), 400);
            }

            if ($availableFree >= $requiredTokens) {
                $wallet->free_balance -= $requiredTokens;
            } else {
                $remainder = $requiredTokens - $availableFree;
                $wallet->free_balance = 0;
                $wallet->balance -= $remainder;
            }
            $wallet->save();
        }
        $profile->workAreas()->sync($requestedAreas);

        return ResponseHelper::make(null, __('lawyer::messages.update_success'));
    }

    public function updateExpertises(UpdateExpertisesRequest $request)
    {
        $lawyer = $this->ClientAuth();
        if (!$lawyer || $lawyer->type !== 'lawyer' || $lawyer->status !== 'accepted') {
            return ResponseHelper::make(null, __('lawyer::messages.update_failed'), 403);
        }

        $profile = $lawyer->legalProfile;
        $wallet = $lawyer->tokenWallet;

        if (!$profile) {
            return ResponseHelper::make(null, __('lawyer::messages.profile_not_found'), 404);
        }
        $requestedExpertises = $request->input('expertises', []);
        $newCount = count($requestedExpertises);
        $currentCount = $profile->expertises()->count();
        $freeLimit = 2;
        $costPerExtra = 2;
        $requiredTokens = 0;

        if ($newCount > $currentCount && $newCount > $freeLimit) {
            $baseCount = max($currentCount, $freeLimit);
            $extraExpertises = $newCount - $baseCount;
            $requiredTokens = $extraExpertises * $costPerExtra;
        }

        if ($requiredTokens > 0) {
            if (!$wallet) {
                return ResponseHelper::make(null, __('lawyer::messages.insufficient_tokens'), 400);
            }
            $isFreeExpired = $wallet->free_expires_at && now()->greaterThan($wallet->free_expires_at);
            $availableFree = $isFreeExpired ? 0 : $wallet->free_balance;
            $totalAvailable = $wallet->balance + $availableFree;

            if ($totalAvailable < $requiredTokens) {
                return ResponseHelper::make(null, __('lawyer::messages.insufficient_tokens'), 400);
            }
            if ($availableFree >= $requiredTokens) {
                $wallet->free_balance -= $requiredTokens;
            } else {
                $remainder = $requiredTokens - $availableFree;
                $wallet->free_balance = 0;
                $wallet->balance -= $remainder;
            }
            $wallet->save();
        }

        $profile->expertises()->sync($requestedExpertises);

        return ResponseHelper::make(null, __('lawyer::messages.update_success'));
    }
    public function ClientAuth()
    {
        return auth('client')->user();
    }
}