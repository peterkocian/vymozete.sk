<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

class File extends Model
{
    use HasDateFormatTrait;
    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = 'files';
    const INDEX_VIEW_PAGINATION = true;
    const INDEX_VIEW_PER_PAGE_SELECT = false;

    const OVERVIEW_VIEW_PAGINATION = false;
    const OVERVIEW_VIEW_PER_PAGE_SELECT = false;

    const SHOW_TO_CUSTOMER_TRUE = '1';
    const SHOW_TO_CUSTOMER_FALSE = '0';

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
        'name', 'filename', 'mime', 'ext', 'path', 'size', 'show_to_customer', 'fileable_id', 'fileable_type', 'file_type_id', 'user_id'
    ];


    /**
     * Accessor => returns file show_to_customer_label attribute as string, default its boolean
     *
     * @return string
     */
    public function getShowToCustomerLabelAttribute(): string
    {
        return $this->getShowToCustomerLabel();
    }

    /**
     * Accessor => returns claimTypeName attribute as translated string, default its foreign key
     *
     * @return string
     */
    public function getClaimTypeNameAttribute(): string
    {
        return $this->claimType->available_translation(Auth::user()->language_id)->exists()
            ? $this->claimType->available_translation(Auth::user()->language_id)->firstOrFail()->name
            : $this->claimType->key;
    }

    /**
     * Accessor => returns fileTypeName attribute as translated string, default its foreign key
     *
     * @return string
     */
    public function getFileTypeNameAttribute(): string
    {
        return $this->fileType->available_translation(Auth::user()->language_id)->exists()
            ? $this->fileType->available_translation(Auth::user()->language_id)->firstOrFail()->name
            : $this->fileType->key;
    }

    /**
     * A file can morph to many objects / class
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
     * @return BelongsTo
     */
    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }

    /**
     * Private function that transform boolean value to string
     *
     * @return string
     */
    private function getShowToCustomerLabel(): string
    {
        switch ($this->show_to_customer) {
            case self::SHOW_TO_CUSTOMER_TRUE:
                return __('general.Yes');
            case self::SHOW_TO_CUSTOMER_FALSE:
                return __('general.No');
        }
    }
}
