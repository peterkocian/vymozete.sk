<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use DateFormatTrait;
    const PERSON_TYPE_FO = 'FO';
    const PERSON_TYPE_PO = 'PO';

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

    /**
     * Get the user record associated with the claim.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPersonTypeAttribute()
    {
        switch ($this->entity_type) {
            case Organization::class:
                return self::PERSON_TYPE_PO;
            case Person::class:
                return self::PERSON_TYPE_FO;
        }
    }
}
