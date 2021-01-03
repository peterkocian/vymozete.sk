<?php

namespace App\Services;

use App\Repositories\CalculationRepositoryInterface;
use Exception;

class CalculationService
{
    private $calculationRepository;
    private $simpleTableService;

    public function __construct(
        CalculationRepositoryInterface $calculationRepository,
        SimpleTableService $simpleTableService
    )
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
            return $this->calculationRepository->save($data, $claim_id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateCalculation($data, $id)
    {
        try {
            $data['paid'] = $data['paid'] ?? 0;
            return $this->calculationRepository->update($data, $id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->calculationRepository->get($id);
            return $this->calculationRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function togglePayed($id)
    {
        try {
            $data = $this->get($id)->toArray();
            $data['paid'] = ($data['paid'] === 1) ? 0 : 1;
            return $this->calculationRepository->update($data, $id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
