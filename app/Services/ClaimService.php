<?php

namespace App\Services;

use App\Repositories\ClaimRepositoryInterface;

class ClaimService
{
    protected $claimRepository;
    private $simpleTableService;

    public function __construct(
        ClaimRepositoryInterface $claimRepository,
        SimpleTableService $simpleTableService
    )
    {
        $this->claimRepository = $claimRepository;
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
//            Log::info($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}
