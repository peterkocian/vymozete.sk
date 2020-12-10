<?php

namespace App\Services;

use Exception;
use App\Repositories\PropertyRepositoryInterface;

class PropertyService
{
    private $propertyRepository;
    private $simpleTableService;

    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        SimpleTableService $simpleTableService
    )
    {
        $this->propertyRepository = $propertyRepository;
        $this->simpleTableService = $simpleTableService;
    }

    public function propertyByClaimId(int $claim_id)
    {
        return $this->simpleTableService->processSimpleTableData($this->propertyRepository, $claim_id, true);
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
