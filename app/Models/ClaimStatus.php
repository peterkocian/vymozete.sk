<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class ClaimStatus extends Model
{
    use DateFormatTrait;
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'claim_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'next_step', 'schedule_ntf', 'timeout'
    ];

    /**
     * Get the claims by claim_status
     */
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function translation($language = null)
    {
//        if ($language == null) { //todo zvazit ci treba
//            $language = App::getLocale();
//        }

        return $this->hasMany(ClaimStatusTranslation::class, 'claim_status_id', 'id')->where('language_id','=', $language);
    }
}
