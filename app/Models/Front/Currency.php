<?php

namespace App\Models\Front;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use DateFormatTrait;
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'currency';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'symbol'
    ];
}
