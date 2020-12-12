<?php

namespace App\Helpers;

trait TranslationTrait
{
    public function translation($data, int $language_id)
    {
        $translations = [];
        foreach ($data as $d) {
            $item = $d->translation($language_id)->firstOrFail();
            array_push($translations, ['id' => $d->id, 'value' => $item->name]);
        }
        return $translations;
    }
}
