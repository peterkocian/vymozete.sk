<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Exception;
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
     * Create an entity.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model //save for file in FileService.php
    {
        return $this->model->create($attributes);
    }

    /**
     * Return an entity by id.
     *
     * @param int $id
     * @param array $relations
     * @return Model
     */
    public function get(int $id, array $relations = []): ?Model
    {
        return $this->model->with($relations)->findOrFail($id);
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
        return $this->model->destroy($id);
    }

    /**
     * Updates an entity by id.
     *
     * @param int $id
     * @param array $attributes
     * @return Model
     * @throws Exception
     */
    public function update(array $attributes, int $id): Model
    {
        try {
            $data = $this->model->findOrFail($id);
        } catch (Exception $e) {
            throw new Exception(__('exception.Not found') . ' ' . $e->getMessage());
        }

        $data->update($attributes);
        return $data;
    }

    public function getData(int $claim_id = null, array $searchParams = []): Builder // tato funkcia musi mat vstupny parameter, lebo v ostatnych Repository classach pretazujem tuto metodu a tam posielam aj parameter
    {
        if (!empty($searchParams)) {
            return $this->model->query()->where(function($q) use($searchParams) {
                foreach ($searchParams as $col => $value) {
                    $q->where($col, 'LIKE' , '%' . $value . '%');
                }
            });
        } else {
            return $this->model::query();
        }
    }

    public function getPagination()
    {
        return $this->model::INDEX_VIEW_PAGINATION;
    }
}
