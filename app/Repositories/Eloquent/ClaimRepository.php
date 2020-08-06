<?php

namespace App\Repositories\Eloquent;

use App\Models\Front\Claim;
use App\Repositories\ClaimRepositoryInterface;
use Illuminate\Support\Collection;

class ClaimRepository extends BaseRepository implements ClaimRepositoryInterface
{
    /**
     * ClaimRepository constructor.
     *
     * @param Claim $model
     */
    public function __construct(Claim $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function allByUser($id): Collection
    {
        return $this->model->all()->where('user_id', $id);
    }
}
