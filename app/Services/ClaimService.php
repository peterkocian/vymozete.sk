<?php

namespace App\Services;

use App\Helpers\SimpleTable;
use App\Repositories\ClaimRepositoryInterface;

class ClaimService
{
    protected $claimRepository;

    public function __construct(ClaimRepositoryInterface $claimRepository)
    {
        $this->claimRepository = $claimRepository;
    }

    public function get($id)
    {
        return $this->claimRepository->get($id);
    }

    /**
     * Returns all entities formatted for index view for SimpleTableComponent with sorting, searching, pagination.
     *
     * @return array
     */
    public function index()
    {
        $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
        $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;
        $pagination = request('pagination') ?? $this->claimRepository->getPagination();

        //sort data
        $query = $this->claimRepository->getData()->orderBy($sortKey,$sortDirection);

        if ($pagination) {
            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;

            $paginate = $query->paginate($rows);
            $data['data'] = $this->claimRepository->getRelatedData($paginate)->toArray();
            $pag = $paginate->toArray();
            unset($pag['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
            $data['pagination'] = $pag;
        } else {
            $data = $this->claimRepository->getRelatedData($query->get())->toArray();
        }

        return $data;
    }
}
