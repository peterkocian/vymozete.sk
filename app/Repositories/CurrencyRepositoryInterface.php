<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface CurrencyRepositoryInterface
{
    public function all(): Collection;
}
