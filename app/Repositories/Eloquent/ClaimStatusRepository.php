<?php

namespace App\Repositories\Eloquent;

use App\Models\ClaimStatus;
use App\Repositories\ClaimStatusRepositoryInterface;

class ClaimStatusRepository extends BaseRepository implements ClaimStatusRepositoryInterface
{
    /**
     * ClaimTypeRepository constructor.
     *
     * @param ClaimStatus $model
     */
    public function __construct(ClaimStatus $model)
    {
        parent::__construct($model);
    }
}
