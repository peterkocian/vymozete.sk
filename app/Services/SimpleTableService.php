<?php

namespace App\Services;

use App\Helpers\SimpleTable;

class SimpleTableService
{
    public function processSimpleTableData($repository, $parent_id, $relatedData): array
    {
        $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
        $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;
        $pagination = request('pagination') ?? $repository->getPagination();

        //get and sort data
        $query = $repository->getData($parent_id)->orderBy($sortKey,$sortDirection);

        if ($pagination) {
            $data = $this->processPagination($query, $repository, $relatedData);
        } else {
            if ($relatedData) {
                $data = $this->processRelatedData($query->get(), $repository);
            } else {
                $data = $query->get()->toArray();
            }
        }

        return $data;
    }

    public function processPagination($query, $repository, $relatedData = false): array
    {
        $data = [];
        $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;

        $paginate = $query->paginate($rows);
        if ($relatedData) {
            $data['data'] = $this->processRelatedData($paginate, $repository);
        } else {
            $data['data'] = collect($paginate->items())->toArray(); // todo items() vracia pole modelov a nie pole poli...opravit
        }
        $pag = $paginate->toArray();
        unset($pag['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
        $data['pagination'] = $pag;
        return $data;
    }

    public function processRelatedData($data, $repository)
    {
        return $repository->getRelatedData($data)->toArray();
    }
}