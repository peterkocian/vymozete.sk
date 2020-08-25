<?php

namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Support\Collection;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    /**
     * FileRepository constructor.
     *
     * @param File $model
     */
    public function __construct(File $model)
    {
        parent::__construct($model);
    }
}
