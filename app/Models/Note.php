<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasClaimTrait;
use App\Traits\HasUserTrait;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasDateFormatTrait, HasClaimTrait, HasUserTrait;

    const ENTITY_ROUTE_PREFIX = 'notes';
    const INDEX_VIEW_PAGINATION = true;
    const INDEX_VIEW_PER_PAGE_SELECT = false;

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
