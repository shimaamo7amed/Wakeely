<?php

namespace Modules\Lawyer\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LawyerResource extends JsonResource
{
    public function toArray($request)
    {
        $user = $this;

        return [
            'user' => [
                'id' => $this->Differentid(),
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'role' => $user->type,
                'status' => $this->getOnboardingStatus(),

                'onboarding' => $this->resolveOnboarding(),

                'profile' => [
                    'avatar' => $user->image ?? null,
                    'phoneNumber' => $user->phone,
                ],
                'connects' => $this->when(
                    $user->type === 'lawyer',
                    $this->tokenWallet?->free_balance ?? 0
                ),
            ]
        ];
    }

    private function Differentid()
    {
        if ($this->type === 'user') {
            return "user_" . $this->id;
        } elseif ($this->type === 'lawyer') {
            return "law_" . $this->id;
        }
    }

    private function resolveOnboarding()
    {
        if ($this->type !== 'lawyer' || $this->status === 'pending' || $this->status === 'accepted') {
            return null;
        }

        return [
            'currentStep' => $this->getCurrentStep(),
            'rejectionReason' => $this->getFirstRejectionReason(),
        ];
    }

    private function getOnboardingStatus()
    {
        if ($this->status === 'accepted') {
            return 'active';
        }

        return $this->status ?? 'incomplete';
    }

    private function getCurrentStep()
    {
        return $this->current_step ?? 1;
    }

    public function getFirstRejectionReason()
    {
        if ($this->status !== 'rejected' || !$this->rejectionReasons) {
            return null;
        }

        $firstReason = $this->rejectionReasons->first();

        if ($firstReason) {
            return $firstReason->pivot ? $firstReason->pivot->custom_comment : ($firstReason->name_ar ?? '');
        }

        return null;
    }
}
