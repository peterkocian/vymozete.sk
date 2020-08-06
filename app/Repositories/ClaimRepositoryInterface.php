<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface ClaimRepositoryInterface
{
    public function all(): Collection;

    public function allByUser($id): Collection;
}
