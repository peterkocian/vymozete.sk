<?php

namespace App\Services;

use App\Traits\HasTranslationTrait;
use App\Repositories\ClaimTypeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ClaimTypeService
{
    use HasTranslationTrait;

    private $claimTypeRepository;

    public function __construct(
        ClaimTypeRepositoryInterface $claimTypeRepository
    )
    {
        $this->claimTypeRepository = $claimTypeRepository;
    }

    public function getDataForSelectbox()
    {
        $claimTypes = $this->claimTypeRepository->all();
        return $this->translation($claimTypes, Auth::user()->language_id);
    }
}
