<?php

namespace App\Traits;

use App\Models\Language;

trait HasAvailableTranslationTrait
{
    /**
     * Get translated value. (claim_status, claim_type...eso)
     *
     * @param null $language_id
     * @return mixed
     */
    public function available_translation($language_id = null)
    {
        if ($language_id === null) {
            $language_id = Language::getDefaultLanguage();
        }

        return $this->translations()->where('language_id', $language_id);
    }
}
