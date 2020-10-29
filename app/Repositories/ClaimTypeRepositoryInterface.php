<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface ClaimTypeRepositoryInterface
{
    public function all(): Collection;

    public function translation(int $language_id);
}
