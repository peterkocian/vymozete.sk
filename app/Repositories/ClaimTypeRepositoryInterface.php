<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface ClaimTypeRepositoryInterface
{
    public function all(): Collection;
}
