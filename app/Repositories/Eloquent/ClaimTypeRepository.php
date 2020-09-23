<?php

namespace App\Repositories\Eloquent;

use App\Models\ClaimType;
use App\Repositories\ClaimTypeRepositoryInterface;
use Illuminate\Support\Collection;

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

    public function translation(int $language_id): Collection
    {
        //todo
        dd('claimTypeRepository:translation');
        return $this->model->translation(2);
    }
}
