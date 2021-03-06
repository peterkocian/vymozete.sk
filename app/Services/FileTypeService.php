<?php

namespace App\Services;

use App\Traits\HasTranslationTrait;
use App\Repositories\FileTypeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class FileTypeService
{
    use HasTranslationTrait;

    private $claimTypeRepository;

    public function __construct(
        FileTypeRepositoryInterface $claimTypeRepository
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
