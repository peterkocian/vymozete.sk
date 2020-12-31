<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Exception;

// custom actions for role repository
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * RoleRepository constructor.
     *
     * @param Role $model
     */
    public function __construct(Role $model)
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
        if ($this->model->save()) {
            $this->model->permissions()->sync($attributes['permissions'] ?? []);
        }

        return $this->model->fresh();
    }

    public function update(array $attributes, int $id): Model
    {
        try {
            $role = $this->model->findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Rolu sa nepodarilo najst.'. $e->getMessage());
        }

        $role->update($attributes);
        $role->permissions()->sync($attributes['permissions'] ?? []);

        return $role;
    }

    public function getDataForSelectbox()
    {
        return $this->model->get(['id', 'name as value'])->toArray();
    }
}
