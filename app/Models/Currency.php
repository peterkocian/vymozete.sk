<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasDateFormatTrait;
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
