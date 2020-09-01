<?php

namespace App\Services;

use App\Repositories\LanguageRepositoryInterface;

class LanguageService
{
    private $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function all()
    {
        return $this->languageRepository->all();
    }
}
