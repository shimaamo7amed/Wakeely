<?php

namespace Modules\Lawyer\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Lawyer\Entities\CardId;
use Modules\Lawyer\Entities\LegalCardId;
use Modules\Lawyer\Entities\LegalProfile;
use Modules\Lawyer\Http\Requests\LawyerCardIDRequest;
use Modules\Lawyer\Http\Requests\LawyerLegalCardRequest;
use Modules\Lawyer\Http\Requests\LawyerRegisterRequest;
use Modules\Lawyer\Http\Resources\LawyerResource;

class APIUpdateController extends BasicController
{
    // UPDATE Step 1 - Legal Info
    public function updateLegalInfo(LawyerRegisterRequest $request)
    {
        $lawyer = $this->ClientAuth();

        if (!$lawyer || $lawyer->type !== 'lawyer') {
            return ResponseHelper::make(null, __('client::messages.unauthenticated'), false, 401);
        }

        if ($lawyer->status !== 'rejected') {
            return ResponseHelper::make(null, __('client::messages.not_rejected'), false, 403);
        }

        $hasLegalInfoRejection = $lawyer->rejectionReasons()
            ->where('reject_reasons.key', 'legal_info')
            ->exists();

        if (!$hasLegalInfoRejection) {
            return ResponseHelper::make(null, __('client::messages.step_not_rejected'), false, 403);
        }

        DB::beginTransaction();
        try {
            if ($lawyer->legalProfile) {
                $lawyer->legalProfile->workAreas()->detach();
                $lawyer->legalProfile->expertises()->detach();
                $lawyer->legalProfile->languages()->detach();
                $lawyer->legalProfile->qualifications()->delete();
                $lawyer->legalProfile->delete();
            }

            $profile = LegalProfile::create([
                'lawyer_id'           => $lawyer->id,
                'bar_association_id'  => $request->bar_association_id,
                'registration_number' => $request->registration_number,
                'registration_date'   => $request->registration_date,
                'sub_associations_id' => $request->sub_associations_id,
                'experience_id'       => $request->experience_id,
                'consultation_price'  => $request->consultation_price,
                'summary'             => $request->summary,
            ]);

            if ($request->filled('qualifications')) {
                $profile->qualifications()->createMany(
                    collect($request->qualifications)->map(fn ($q) => [
                        'degree_type_id' => $q['degree_type_id'],
                        'university_id'  => $q['university_id'],
                        'year'           => $q['year'],
                    ])->toArray()
                );
            }

            if ($request->filled('work_areas')) {
                $profile->workAreas()->sync($request->work_areas);
            }
            if ($request->filled('expertises')) {
                $profile->expertises()->sync($request->expertises);
            }
            if ($request->filled('languages')) {
                $profile->languages()->sync($request->languages);
            }

            $legalInfoReasonIds = $lawyer->rejectionReasons()
                ->where('reject_reasons.key', 'legal_info')
                ->pluck('reject_reasons.id');

            $lawyer->rejectionReasons()->detach($legalInfoReasonIds);

            $remainingRejections = $lawyer->rejectionReasons()->count();
            $this->recalculateLawyerStatus($lawyer, $remainingRejections);

            DB::commit();

            $lawyer->refresh()->load('legalProfile.qualifications.degreeType', 'legalProfile.qualifications.university');

            return ResponseHelper::make(
                new LawyerResource($lawyer),
                __('client::messages.updated_successfully'),
                true,
                200
            );

        } catch (HttpResponseException $e) {
            throw $e; // ← بدون DB::rollBack

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('LegalProfile update failed: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return ResponseHelper::make(null, $e->getMessage(), false, 500);
        }
    }

    // UPDATE Step 2 - Card ID
    public function updateCardID(LawyerCardIDRequest $request)
    {
        $lawyer = $this->ClientAuth();

        if (!$lawyer || $lawyer->type !== 'lawyer') {
            return ResponseHelper::make(null, __('client::messages.unauthenticated'), false, 401);
        }

        if ($lawyer->status !== 'rejected') {
            return ResponseHelper::make(null, __('client::messages.not_rejected'), false, 403);
        }

        $hasIdCardRejection = $lawyer->rejectionReasons()
            ->where('reject_reasons.key', 'id_card')
            ->exists();

        if (!$hasIdCardRejection) {
            return ResponseHelper::make(null, __('client::messages.step_not_rejected'), false, 403);
        }

        DB::beginTransaction();
        try {
            if ($lawyer->cardId) {
                $lawyer->cardId->delete();
            }

            $frontPath = $request->hasFile('front_id_card')
                ? Upload::uploadFile($request->file('front_id_card'), 'lawyer_id_cards')
                : null;

            $backPath = $request->hasFile('back_id_card')
                ? Upload::uploadFile($request->file('back_id_card'), 'lawyer_id_cards')
                : null;

            CardId::create([
                'lawyer_id'     => $lawyer->id,
                'front_id_card' => $frontPath,
                'back_id_card'  => $backPath,
            ]);

            $idCardReasonIds = $lawyer->rejectionReasons()
                ->where('reject_reasons.key', 'id_card')
                ->pluck('reject_reasons.id');

            $lawyer->rejectionReasons()->detach($idCardReasonIds);

            $remainingRejections = $lawyer->rejectionReasons()->count();
            $this->recalculateLawyerStatus($lawyer, $remainingRejections);

            DB::commit();

            $lawyer->refresh();

            return ResponseHelper::make(
                new LawyerResource($lawyer),
                __('client::messages.updated_successfully'),
                true,
                200
            );

        } catch (HttpResponseException $e) {
            throw $e; // ← بدون DB::rollBack

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('CardID update failed: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return ResponseHelper::make(null, $e->getMessage(), false, 500);
        }
    }

    // UPDATE Step 3 - Legal Card
    public function updateLegalCard(LawyerLegalCardRequest $request)
    {
        $lawyer = $this->ClientAuth();

        if (!$lawyer || $lawyer->type !== 'lawyer') {
            return ResponseHelper::make(null, __('client::messages.unauthenticated'), false, 401);
        }

        if ($lawyer->status !== 'rejected') {
            return ResponseHelper::make(null, __('client::messages.not_rejected'), false, 403);
        }

        $hasLegalCardRejection = $lawyer->rejectionReasons()
            ->where('reject_reasons.key', 'legal_card')
            ->exists();

        if (!$hasLegalCardRejection) {
            return ResponseHelper::make(null, __('client::messages.step_not_rejected'), false, 403);
        }

        DB::beginTransaction();
        try {
            if ($lawyer->LegalCardId) {
                $lawyer->LegalCardId->delete();
            }

            $frontPath = $request->hasFile('front_legal_card')
                ? Upload::uploadFile($request->file('front_legal_card'), 'lawyer_legal_cards')
                : null;

            $backPath = $request->hasFile('back_legal_card')
                ? Upload::uploadFile($request->file('back_legal_card'), 'lawyer_legal_cards')
                : null;

            LegalCardId::create([
                'lawyer_id'        => $lawyer->id,
                'front_legal_card' => $frontPath,
                'back_legal_card'  => $backPath,
            ]);

            $legalCardReasonIds = $lawyer->rejectionReasons()
                ->where('reject_reasons.key', 'legal_card')
                ->pluck('reject_reasons.id');

            $lawyer->rejectionReasons()->detach($legalCardReasonIds);

            $remainingRejections = $lawyer->rejectionReasons()->count();
            $this->recalculateLawyerStatus($lawyer, $remainingRejections);

            DB::commit();

            $lawyer->refresh();

            return ResponseHelper::make(
                new LawyerResource($lawyer),
                __('client::messages.updated_successfully'),
                true,
                200
            );

        } catch (HttpResponseException $e) {
            throw $e; // ← بدون DB::rollBack

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('LegalCard update failed: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return ResponseHelper::make(null, $e->getMessage(), false, 500);
        }
    }

    // HELPER
    private function recalculateLawyerStatus($lawyer, int $remainingRejections): void
    {
        if ($remainingRejections === 0) {
            $lawyer->status       = 'pending';
            $lawyer->is_submitted = true;
            $lawyer->current_step = 4;
        } else {
            $stepMap = [
                'legal_info' => 1,
                'id_card'    => 2,
                'legal_card' => 3,
            ];

            $remainingKeys = $lawyer->rejectionReasons()
                ->pluck('reject_reasons.key')
                ->toArray();

            $remainingSteps = array_filter(
                array_map(fn ($key) => $stepMap[$key] ?? null, $remainingKeys)
            );

            $minStep = count($remainingSteps) > 0 ? min($remainingSteps) : 1;

            $lawyer->status       = 'rejected';
            $lawyer->is_submitted = false;
            $lawyer->current_step = $minStep;
        }

        $lawyer->save();
    }

    public function ClientAuth()
    {
        return auth('client')->user();
    }
}
