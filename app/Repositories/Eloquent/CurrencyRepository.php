<?php

namespace App\Repositories\Eloquent;

use App\Models\Currency;
use App\Repositories\CurrencyRepositoryInterface;

class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    /**
     * CurrencyRepository constructor.
     *
     * @param Currency $model
     */
    public function __construct(Currency $model)
    {
        parent::__construct($model);
    }

    public function getDataForSelectbox()
    {
        return $this->model->get(['id', 'code as value'])->toArray();
    }
}
