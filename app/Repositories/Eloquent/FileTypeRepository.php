<?php

namespace App\Repositories\Eloquent;

use App\Models\FileType;
use App\Repositories\FileTypeRepositoryInterface;
use Illuminate\Support\Collection;

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

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function files(int $id)
    {
        return $this->model->files();
    }

    public function getDataForSelectbox()
    {
        return FileType::get(['id', 'name as value'])->toArray();
    }
}
