<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface CalendarRepositoryInterface
{
    public function all(): Collection;
}
