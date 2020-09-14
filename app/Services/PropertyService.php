<?php

namespace App\Services;

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
        return $this->propertyRepository->propertyByClaimId($claim_id);
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
