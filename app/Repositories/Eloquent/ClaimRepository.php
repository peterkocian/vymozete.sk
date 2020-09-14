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

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->with(['creditor.entity.fullname', 'debtor'])->get();
    }

    public function allByUser(int $id): Collection
    {
        return $this->model->all()->where('user_id', $id);
    }

    public function getData(): Builder
    {
        return Claim::query();
    }

//    todo zistit ktory interface predpisuje tuto funkciu
    public function getRelatedData($data): array
    {
        return $data->append([
            'amountWithCurrency',
            'debtorFullName',
            'creditorFullName',
            'typeName',
            'statusName'
        ])->toArray();
    }
}
