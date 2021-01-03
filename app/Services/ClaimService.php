<?php

namespace App\Services;

use App\Repositories\ClaimRepositoryInterface;
use App\Repositories\CurrencyRepositoryInterface;

class ClaimService
{
    protected $claimRepository;
    protected $currencyRepository;
    private $simpleTableService;

    public function __construct(
        ClaimRepositoryInterface $claimRepository,
        CurrencyRepositoryInterface $currencyRepository,
        SimpleTableService $simpleTableService
    )
    {
        $this->claimRepository = $claimRepository;
        $this->currencyRepository = $currencyRepository;
        $this->simpleTableService = $simpleTableService;
    }

    public function get(int $claim_id)
    {
        return $this->claimRepository->get($claim_id, ['currency']);
    }

    public function getDebtor(int $claim_id)
    {
        return $this->claimRepository->getDebtor($claim_id);
    }

    public function getCreditor(int $claim_id)
    {
        return $this->claimRepository->getCreditor($claim_id);
    }

    /**
     * Returns all entities formatted for index view for SimpleTableComponent with sorting, searching, pagination.
     *
     * @return array
     */
    public function all()
    {
        return $this->simpleTableService->processSimpleTableData($this->claimRepository, null, true);
    }

    public function updateBaseData(array $data, int $claim_id)
    {
        try {
            return $this->claimRepository->update($data, $claim_id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllDebtors($data): array
    {
        $debtors = [];
        foreach ($data as $d) {
            if (isset($d['debtorFullName'])) {
                $d['debtor']['fullName'] = $d['debtorFullName'];
            } else {
                throw new \Exception('debtorFullName neexistuje');
            }
            array_push($debtors,$d['debtor']);
        }
        return $this->formatForSelectbox($debtors);;
    }

    public function getAllCreditors($data): array
    {
        $creditors = [];
        foreach ($data as $d) {
            if (isset($d['creditorFullName'])) {
                $d['creditor']['fullName'] = $d['creditorFullName'];
            } else {
                throw new \Exception('creditorFullName neexistuje');
            }
            array_push($creditors,$d['creditor']);
        }
        return $this->formatForSelectbox($creditors);
    }

    public function getCurrencyList()
    {
        return $this->currencyRepository->getDataForSelectbox();
    }

    private function formatForSelectbox($data): array
    {
        return  array_map(function ($d) {
            return [
                'id'   => $d['id'],
                'value' => $d['fullName'],
            ];
        }, $data);
    }
}
