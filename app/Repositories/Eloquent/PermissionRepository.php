<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Exception;

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
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
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

    public function update(array $attributes, int $id): Model
    {
        if ($id) {
            try {
                $permission = $this->model->findOrFail($id);
            } catch (Exception $e) {
                report($e);
                throw new Exception('Opravnenie sa nepodarilo najst.'. $e->getMessage());
            }
        }

        if ($permission) {
            $permission->update($attributes);

            return $permission;
        }
    }
}
