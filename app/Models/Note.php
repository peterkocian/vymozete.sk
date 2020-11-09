<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use DateFormatTrait;

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

    /**
     * Get the claim that owns the note.
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * Get the user that owns the note.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
