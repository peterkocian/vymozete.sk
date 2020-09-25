<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface CalculationRepositoryInterface
{
    /**
     * @param array $attributes
     * @param int $claim_id
     * @return Model
     */
    public function save(array $attributes, int $claim_id): Model;

//    public function getData(int $claim_id): Builder;
}
