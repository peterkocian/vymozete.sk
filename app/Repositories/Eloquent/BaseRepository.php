<?php

namespace App\Repositories\Eloquent;

use App\Helpers\SimpleTable;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
            $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
            $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;

            $data = $model::orderBy($sortKey, $sortDirection);

            if ($pagination) {
                $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;

                $paginate = $data->paginate($rows);
                $result['data'] = $paginate->items();
                $pag = $paginate->toArray();
                unset($pag['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
                $result['pagination'] = $pag;
            } else {
                $result = $data->get()->toArray();
            }

            return $result;
        }
    }

//    public function getData(Model $model)
//    {
//        $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
//        $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;
//        $pagination = request('pagination') ?? $this->getPagination();
//
//        //sort data
//        $query = $model::orderBy($sortKey,$sortDirection);
//
//        if ($pagination) {
//            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;
//
//            $paginate = $query->paginate($rows);
////            $data['data'] = $this->claimRepository->getRelatedData($paginate)->toArray();
//            $data['data'] = $paginate->items();
//            $pag = $paginate->toArray();
//            unset($pag['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
//            $data['pagination'] = $pag;
//        } else {
////            $data = $this->claimRepository->getRelatedData($query->get())->toArray();
//            $data = $query->get()->toArray();
//        }
//
//        return $data;
//    }

    public function getPagination()
    {
        return $this->model::INDEX_VIEW_PAGINATION;
    }

}
