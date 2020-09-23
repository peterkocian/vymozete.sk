<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    use DateFormatTrait;
    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = 'files';
    const INDEX_VIEW_PAGINATION = true;
    const INDEX_VIEW_PER_PAGE_SELECT = false;

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

    public function getShowToCustomerNameAttribute()
    {
        return $this->getShowToCustomerName();
    }

    public function getFileTypeNameAttribute()
    {
        return $this->fileType->name;
    }

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
     * @return BelongsTo
     */
    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }

    public function getShowToCustomerName()
    {
        switch ($this->show_to_customer) {
            case self::SHOW_TO_CUSTOMER_TRUE:
                return __('general.Yes');
            case self::SHOW_TO_CUSTOMER_FALSE:
                return __('general.No');
        }
    }
}
