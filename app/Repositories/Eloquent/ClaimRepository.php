<?php

namespace App\Repositories\Eloquent;

use App\Models\Claim;
use App\Models\ClaimType;
use App\Models\Currency;
use App\Models\Organization;
use App\Models\Person;
use App\Repositories\ClaimRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
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
        return $this->all()->where('user_id', $id);
    }

    public function update(array $attributes, int $id): Model //todo prepisat funkcionalitu do service
    {
        $result = $creditorModel = $debtorModel = $claimType = $currency = null;
        $updateClaimType = $updateCurrency = $updateCreditor = $updateDebtor = $updateFiles = false;
        if ($id) {
            try {
                $result = $this->model->findOrFail($id);
            } catch (\Exception $e) {
                throw new \Exception('Pohladavku sa nepodarilo najst z neznamych dovod.'. $e->getMessage());
            }
        }

        if (isset($attributes['claim_type_id']))
        {
            $updateClaimType = true;
            $claimType = ClaimType::findOrFail($attributes['claim_type_id']);
        }
        if (isset($attributes['currency_id']))
        {
            $updateCurrency = true;
            $currency  = Currency::findOrFail($attributes['currency_id']);
        }
        if (isset($attributes['creditor_id']))
        {
            $updateCreditor = true;
            $creditorModel = $attributes['person_type'] == 1 ? Organization::findOrFail($attributes['creditor_id']) : Person::findOrFail($attributes['creditor_id']);
        }
        if (isset($attributes['debtor_id']))
        {
            $updateDebtor = true;
            $debtorModel = $attributes['person_type'] == 1 ? Organization::findOrFail($attributes['debtor_id']) : Person::findOrFail($attributes['debtor_id']);
        }

        if ($result) {
            $result->update($attributes);
            $updateClaimType ? $result->claimType()->associate($claimType) : null;
            $updateCurrency ? $result->currency()->associate($currency) : null;
            $updateCreditor ? $creditorModel->update($attributes) : null;
            $updateDebtor ? $debtorModel->update($attributes) : null;

            if ($result->save()) {
                return $result;
            }
        }
        throw new \Exception('Update pohladavky sa nepodaril.');
    }

    public function getRelatedData($data): Collection
    {
        return $data->append([
            'amountWithCurrency',
            'debtorFullName',
            'creditorFullName',
            'claimTypeName',
            'statusName'
        ]);
    }
}
