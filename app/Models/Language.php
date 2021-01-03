<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasDateFormatTrait;
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'language';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'name', 'default'
    ];

    public static function getDefaultLanguage()
    {
        return self::query()->where('default',1)->get();
    }
}
