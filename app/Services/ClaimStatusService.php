<?php

namespace App\Services;

use App\Traits\HasTranslationTrait;
use App\Repositories\ClaimStatusRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ClaimStatusService
{
    use HasTranslationTrait;

    private $claimStatusRepository;

    public function __construct(
        ClaimStatusRepositoryInterface $claimStatusRepository
    )
    {
        $this->claimStatusRepository = $claimStatusRepository;
    }

    public function getDataForSelectbox()
    {
        $claimStatus = $this->claimStatusRepository->all();
        return $this->translation($claimStatus, Auth::user()->language_id);
    }
}
