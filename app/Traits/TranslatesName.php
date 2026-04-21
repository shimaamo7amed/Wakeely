<?php

namespace App\Traits;

trait TranslatesName
{
    protected function translatedName(): string
    {
        return app()->getLocale() === 'ar'
            ? $this->name_ar
            : $this->name_en;
    }
}
