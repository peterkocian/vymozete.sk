<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

// custom actions for permission repository
class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    /**
     * PermissionRepository constructor.
     *
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    /**
     * Create an entity.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function save(array $attributes): Model
    {
        $this->model->fill($attributes);
        $this->model->save();

        return $this->model->fresh();
    }

    public function getDataForSelectbox()
    {
        return $this->model->get(['id', 'name as value'])->toArray();
    }
}
