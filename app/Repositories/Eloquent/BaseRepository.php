<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get empty model object
     *
     * @return Model
     */
    public function getProjection(): Model
    {
        return $this->model;
    }

    /**
     * Set data to model object
     *
     * @param array $attributes
     * @return Model
     */
    public function setProjection(array $attributes): Model
    {
        return $this->model->fill($attributes);
    }

    /**
     * Create an entity.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Return an entity by id.
     *
     * @param $id
     * @return Model
     */
    public function get($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Returns all entities from model.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Deletes an entity by id.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id): boolean
    {
        return $this->model->destroy($id);
    }

    /**
     * Updates an entity by id.
     *
     * @param int $id
     * @param array $attributes
     * @return Model
     */
    public function update(array $attributes, $id): Model
    {
        return $this->model->find($id)->update($attributes);
    }
}
