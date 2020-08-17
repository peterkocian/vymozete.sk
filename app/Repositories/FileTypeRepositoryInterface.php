<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface FileTypeRepositoryInterface
{
    public function all(): Collection;

    public function files(int $id);
}
