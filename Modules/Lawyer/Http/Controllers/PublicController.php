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
        
        $existingIds = $profile->workAreas()->pluck('law_work_areas.id')->toArray();
            $newIdsToAdd = array_diff($requestedAreas, $existingIds);
        $newCountToAdd = count($newIdsToAdd);
        if ($newCountToAdd === 0) {
            return ResponseHelper::make(null, __('lawyer::messages.update_success'));
        }
        $currentTotalCount = count($existingIds);
        $freeLimit = 2;
        $costPerExtra = 2;
        $requiredTokens = 0;

        // حساب التكلفة بناءً على الإضافات الجديدة فقط
        foreach ($newIdsToAdd as $index => $id) {
            $position = $currentTotalCount + $index + 1; // ترتيب العنصر الجديد
            if ($position > $freeLimit) {
                $requiredTokens += $costPerExtra;
            }
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

        $profile->workAreas()->syncWithoutDetaching($newIdsToAdd);

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
            $existingIds = $profile->expertises()->pluck('law_expertises.id')->toArray();
            $newIdsToAdd = array_diff($requestedExpertises, $existingIds);
        $newCountToAdd = count($newIdsToAdd);

        if ($newCountToAdd === 0) {
            return ResponseHelper::make(null, __('lawyer::messages.update_success'));
        }

        $currentTotalCount = count($existingIds);
        $freeLimit = 2;
        $costPerExtra = 2;
        $requiredTokens = 0;
        foreach ($newIdsToAdd as $index => $id) {
            $position = $currentTotalCount + $index + 1;
            if ($position > $freeLimit) {
                $requiredTokens += $costPerExtra;
            }
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
        $profile->expertises()->syncWithoutDetaching($newIdsToAdd);

        return ResponseHelper::make(null, __('lawyer::messages.update_success'));
    }
    public function ClientAuth()
    {
        return auth('client')->user();
    }
}