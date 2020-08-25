<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    use DateFormatTrait;
    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = '/admin/claims/';

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'file';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'filename', 'mime', 'ext', 'path', 'size', 'show-to-customer', 'fileable_id', 'fileable_type', 'file_type_id', 'user_id'
    ];

    /**
     *
     *
     * @return MorphTo
     */
    public function claim()
    {
        return $this->morphTo();
    }

    /**
     * A file belongs to user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A file has one file type
     *
     * @return HasOne
     */
    public function fileType()
    {
        return $this->hasOne(FileType::class);
    }
}
