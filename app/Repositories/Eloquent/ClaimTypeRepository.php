<?php

namespace App\Repositories\Eloquent;

use App\Models\ClaimType;
use App\Repositories\ClaimTypeRepositoryInterface;

class ClaimTypeRepository extends BaseRepository implements ClaimTypeRepositoryInterface
{
    /**
     * ClaimTypeRepository constructor.
     *
     * @param ClaimType $model
     */
    public function __construct(ClaimType $model)
    {
        parent::__construct($model);
    }
}
