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
            $data['paid'] = $data['paid'] ?? 0;
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

    public function getTrovy($claim): float
    {
        $fee = 0;
        if ($claim['amount'] >= 0 && $claim['amount'] <= 165.97) {
            $fee = 16.60;
        } elseif ($claim['amount'] > 165.97 && $claim['amount'] <= 663.88) {
            $fee = 16.60;
            $fee += ceil(($claim['amount'] - 165.97) / 33.19) * 1.66;
        } elseif ($claim['amount'] > 663.88 && $claim['amount'] <= 6638.78) {
            $fee = 41.49;
            $fee += ceil(($claim['amount'] - 663.88) / 331.94) * 9.96;
        } elseif ($claim['amount'] > 6638.78 && $claim['amount'] <= 33193.92) {
            $fee = 220.74;
            $fee += ceil(($claim['amount'] - 6638.78) / 1659.70) * 16.60;
        } elseif ($claim['amount'] > 33193.92) {
            $fee = 486.29;
            $fee += ceil(($claim['amount'] - 33193.92) / 3319.39) * 6.64;
        }
        return $fee;
    }

    public function summary($claim, $trovyDPH = 0, $urok = 0)
    {
        return $claim['amount'] + $trovyDPH + $urok;
    }

    public function getVymozete($claim_id)
    {
        return $this->calculationRepository->getVymozene($claim_id);
    }
}
