<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

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
    public function get(int $id): ?Model
    {
        return $this->model->findOrFail($id);
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
    public function delete(int $id): bool
    {
//        dd($this->model->findOrFail($id));
        return $this->model->destroy($id);
    }

    /**
     * Updates an entity by id.
     *
     * @param int $id
     * @param array $attributes
     * @return Model
     */
    public function update(array $attributes, int $id): Model
    {
        return $this->model->findOrFail($id)->update($attributes);
    }

    public function getData(int $claim_id = null): Builder // tato funkcia musi mat vstupny parameter, lebo v ostatnych Repository classach pretazujem tuto metodu a tam posielam aj parameter
    {
        return $this->model::query();
    }

    public function getPagination()
    {
        return $this->model::INDEX_VIEW_PAGINATION;
    }
}
