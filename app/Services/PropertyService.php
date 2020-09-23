<?php

namespace App\Services;

use App\Helpers\SimpleTable;
use Exception;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PropertyService
{
    private $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function propertyByClaimId(int $claim_id)
    {
        $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
        $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;
        $pagination = request('pagination') ?? $this->propertyRepository->getPagination();

        //sort data
        $query = $this->propertyRepository->getData($claim_id)->orderBy($sortKey,$sortDirection);

        if ($pagination) {
            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;

            $paginate = $query->paginate($rows);
            $data['data'] = $this->propertyRepository->getRelatedData($paginate)->toArray();
            $pag = $paginate->toArray();
            unset($pag['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
            $data['pagination'] = $pag;
        } else {
            $data = $this->propertyRepository->getRelatedData($query->get())->toArray();
        }

        return $data;
    }

    public function saveProperty(array $data, int $claim_id)
    {
        try {
            $result = $this->propertyRepository->save($data, $claim_id);
        } catch (Exception $e) {
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function destroy(int $id)
    {
        try {
            $this->propertyRepository->get($id);
            $result = $this->propertyRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $result;
    }
}
