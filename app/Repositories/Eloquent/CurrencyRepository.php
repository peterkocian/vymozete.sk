<?php

namespace App\Repositories\Eloquent;

use App\Models\Currency;
use App\Repositories\CurrencyRepositoryInterface;
use Illuminate\Support\Collection;

class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    /**
     * CurrencyTypeRepository constructor.
     *
     * @param Currency $model
     */
    public function __construct(Currency $model)
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

    public function getDataForSelectbox()
    {
        return Currency::get(['id', 'code as value'])->toArray();
    }
}
