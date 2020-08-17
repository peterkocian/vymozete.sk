<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface ClaimRepositoryInterface
{
    public function all(): Collection;

    public function index(): Collection;

    public function allByUser(int $id): Collection;

    public function files(int $id);
}
