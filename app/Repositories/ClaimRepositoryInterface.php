<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface ClaimRepositoryInterface
{
    public function all(): Collection;

    public function allByUser(int $id): Collection;

//    public function getData(): Builder;
}
