<?php

namespace App\Services;

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
}
