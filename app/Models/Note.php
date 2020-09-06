<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use DateFormatTrait;

    const ENTITY_ROUTE_PREFIX = 'notes';
    const INDEX_VIEW_PAGINATION = true;

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'note';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'claim_id', 'user_id'];
}
