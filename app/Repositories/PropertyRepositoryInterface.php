<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface PropertyRepositoryInterface
{
    /**
     * @param array $attributes
     * @param $claim_id
     * @return Model
     */
    public function save(array $attributes, $claim_id): Model;
}
