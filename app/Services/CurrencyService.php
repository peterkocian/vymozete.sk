<?php

namespace App\Services;

use App\Repositories\CurrencyRepositoryInterface;

class CurrencyService
{
    private $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function all()
    {
        return $this->currencyRepository->all();
    }
}
