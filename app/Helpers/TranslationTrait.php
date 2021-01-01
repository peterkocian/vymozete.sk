<?php

namespace App\Helpers;

trait TranslationTrait
{

    /**
     * Funkcia vracia pole prelozenych hodnot pre selectbox
     *
     * @param $data
     * @param int $language_id
     * @return array
     */
    public function translation($data, int $language_id)
    {
        $translations = [];
        foreach ($data as $d) {
            if($d->available_translation($language_id)->exists()){
                $item = $d->available_translation($language_id)->firstOrFail();
                array_push($translations, ['id' => $d->id, 'value' => $item->name]);
            } else {
                array_push($translations, ['id' => $d->id, 'value' => $d->key]);
            }
        }
        return $translations;
    }
}
