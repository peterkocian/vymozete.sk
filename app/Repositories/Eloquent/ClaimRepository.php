<?php

namespace App\Repositories\Eloquent;

use App\Models\Claim;
use App\Repositories\ClaimRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
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

//    /**
//     * @return Collection
//     */
//    public function all(): Collection
//    {
//        return $this->model->with(['creditor.entity.fullname', 'debtor'])->get();
//    }

    public function getDebtor(int $claim_id)
    {
        return $this->get($claim_id)->debtor->entity;
    }

    public function getCreditor(int $claim_id)
    {
        return $this->get($claim_id)->creditor->entity;
    }

    public function allByUser(int $id): Collection
    {
        return $this->model->all()->where('user_id', $id);
    }

//    public function getData(): Builder
//    {
//        return Claim::query();
//    }

    public function getRelatedData($data): Collection
    {
        return $data->append([
            'amountWithCurrency',
            'debtorFullName',
            'creditorFullName',
            'typeName',
            'statusName'
        ]);
    }
}
