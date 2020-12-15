<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class ClaimType extends Model
{
    use DateFormatTrait;
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'claim_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key'
    ];

    /**
     * Get the claims by claim_type
     */
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function translations()
    {
        return $this->hasMany(ClaimTypeTranslation::class, 'claim_type_id', 'id');
    }

    public function available_translation($language_id = null)
    {
//        if ($language == null) { //todo zvazit ci treba
//            $language = App::getLocale();
//        }

        return $this->translations()->where('language_id',$language_id);
    }
}
