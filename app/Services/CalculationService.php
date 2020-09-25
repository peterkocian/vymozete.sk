<?php

namespace App\Services;

use App\Repositories\CalculationRepositoryInterface;
use Exception;

class CalculationService
{
    private $calculationRepository;
    private $simpleTableService; //todo

    public function __construct(CalculationRepositoryInterface $calculationRepository, SimpleTableService $simpleTableService)
    {
        $this->calculationRepository = $calculationRepository;
        $this->simpleTableService = $simpleTableService;
    }

    public function get($id)
    {
        return $this->calculationRepository->get($id);
    }

    public function calculationsByClaimId(int $claim_id)
    {
        return $this->simpleTableService->processSimpleTableData($this->calculationRepository, $claim_id, true);
    }

    public function saveCalculation(array $data, int $claim_id)
    {
        try {
            $result = $this->calculationRepository->save($data, $claim_id);
        } catch (Exception $e) {
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function updateCalculation($data, $id)
    {
        try {
            $result = $this->calculationRepository->update($data, $id);
        } catch (Exception $e) {
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function destroy(int $id)
    {
        try {
            $this->calculationRepository->get($id);
            $result = $this->calculationRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $result;
    }
}
