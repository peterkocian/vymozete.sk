<?php

namespace App\Models\Front;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
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
            case 'App\Models\Front\Organization':
                return self::PERSON_TYPE_PO;
            case 'App\Models\Front\Person':
                return self::PERSON_TYPE_FO;
        }
    }
}
