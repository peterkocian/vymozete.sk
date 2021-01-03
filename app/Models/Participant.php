<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasUserTrait;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasDateFormatTrait, HasUserTrait;

    const PERSON_TYPE = [
        [
            'id' => 0,
            'value' => 'fyzická osoba (nepodnikateľ)'
        ],
        [
            'id' => 1,
            'value' => 'podnikateľ (živnostník, s.r.o., ...)'
        ]
    ];

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'participant';

    public function entity()
    {
        return $this->morphTo();
    }
}
