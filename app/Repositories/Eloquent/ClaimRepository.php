<?php

namespace App\Repositories\Eloquent;

use App\Models\Claim;
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
        return $this->model->with(['creditor.entity.fullname', 'debtor'])->get();
    }

    public function index(): Collection
    {
        $claims = $this->model->all();

        foreach ($claims as $claim) {
            $claim['amountWithCurrency'] = $claim->amountWithCurrency;
            $claim['debtorPlain']   = $claim->debtor->entity->fullname;
            $claim['creditorPlain'] = $claim->creditor->entity->fullname;
            $claim['statusPlain']   = $claim->claimStatus->name;
            $claim['typePlain']     = $claim->claimType->translation(\Illuminate\Support\Facades\Auth::user()->language_id)->firstOrFail()->name;
        }

//        dd($claims);
        return $claims;
//        return $this->model->all();
    }

    public function allByUser(int $id): Collection
    {
        return $this->model->all()->where('user_id', $id);
    }

    public function files(int $id)
    {
        return $this->model->files();
    }
}
