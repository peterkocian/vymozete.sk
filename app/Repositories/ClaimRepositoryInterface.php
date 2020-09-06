<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ClaimRepositoryInterface
{
    public function all(): Collection;

    public function index(): array;

    public function allByUser(int $id): Collection;

    public function files(int $id);

    public function getTableData(Model $model);
}
