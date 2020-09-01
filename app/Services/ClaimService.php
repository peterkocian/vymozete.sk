<?php

namespace App\Services;

use App\Repositories\ClaimRepositoryInterface;

class ClaimService
{
    private $claimRepository;

    public function __construct(ClaimRepositoryInterface $claimRepository)
    {
        $this->claimRepository = $claimRepository;
    }
}
