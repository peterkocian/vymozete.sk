<?php

namespace App\Repositories\Eloquent;

use App\Helpers\SimpleTable;
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
    public function delete(int $id): boolean
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
    public function update(array $attributes, int $id): Model
    {
        return $this->model->findOrFail($id)->update($attributes);
    }

    /**
     * Returns all entities formated for index view for SimpleTableComponent with sorting, searching, pagination.
     *
     * @param Model $model
     * @return array
     */
    public function getTableData(Model $model)
    {
        $pagination = request('pagination') ?? $model::INDEX_VIEW_PAGINATION;

        if ($model)
        {
            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;
            $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
            $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;
            $search = request('search') ? request('search') : SimpleTable::SEARCH;

//            if (count($search) > 0) {
//                $query = $model::where(function($q) use($search,$model) {
//                    foreach ($search as $col => $value) {
//                        if ($col === 'status') {
//                            if ($value === $model::STATUS_REGISTERED) {
//                                $q->where($value, 1)->where($model::STATUS_APPROVED,0)->where($model::STATUS_REJECTED,0);
//                            } else {
//                                $q->where($value, 1);
//                            }
//                        }
//                        elseif (strlen($value) > 0) {
//                            $q->where($col, 'LIKE' , '%' . $value . '%');
//                        }
//                    }
//                })->orderBy($sortKey, $sortDirection);
//            } else {
//                $query = $model::orderBy($sortKey, $sortDirection);
//            }

            $result = $model::orderBy($sortKey, $sortDirection);

            if ($pagination) {
                $result = $result->paginate($rows);
            } else {
                $result = $result->get()->toArray();
            }

            return $result;
        }
    }
}
