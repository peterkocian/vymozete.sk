<?php

namespace App\Repositories\Eloquent;

use App\Models\FileType;
use App\Repositories\FileTypeRepositoryInterface;

class FileTypeRepository extends BaseRepository implements FileTypeRepositoryInterface
{
    /**
     * FileTypeRepository constructor.
     *
     * @param FileType $model
     */
    public function __construct(FileType $model)
    {
        parent::__construct($model);
    }

    public function getDataForSelectbox()
    {
        return FileType::get(['id', 'name as value'])->toArray();
    }
}
