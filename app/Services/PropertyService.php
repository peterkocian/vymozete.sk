<?php

namespace App\Services;

use Exception;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PropertyService
{
    private $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function index($properties): Collection
    {
        try {
            $result = $this->propertyRepository->index($properties);
        } catch (Exception $e) {
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa vyhladat udaje'. $e->getMessage());
        }

        return $result;
//        foreach ($properties as $property) {
//            $property['amountWithCurrency'] = $property->amountWithCurrency;
//        }
//
//        return $properties;
    }

    public function saveProperty(array $data, int $claim_id)
    {
        DB::beginTransaction();

        try {
            $result = $this->propertyRepository->save($data, $claim_id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
        }

        return $result;
    }
}
