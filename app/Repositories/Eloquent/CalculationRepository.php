<?php

namespace App\Repositories\Eloquent;

use App\Models\Calculation;
use App\Repositories\CalculationRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

// custom actions for calculation repository
class CalculationRepository extends BaseRepository implements CalculationRepositoryInterface
{
    private $claimRepository;

    /**
     * NoteRepository constructor.
     *
     * @param Calculation $model
     * @param ClaimRepository $claimRepository
     */
    public function __construct(
        Calculation $model,
        ClaimRepository $claimRepository
    )
    {
        parent::__construct($model);
        $this->claimRepository = $claimRepository;
    }

    /**
     * Create an entity.
     *
     * @param array $attributes
     * @param int $claim_id
     * @return Model
     */
    public function save(array $attributes, int $claim_id): Model
    {
        $claim = $this->claimRepository->get($claim_id);
        $attributes['claim_id'] = $claim->id;
        $attributes['user_id'] = Auth::id();

        return $this->model->create($attributes);
    }

    public function getData(int $claim_id = null, array $searchParams = []): Builder // pretazena metoda z BaseRepository
    {
        return $this->claimRepository->get($claim_id)->calculations()->getQuery();
    }

    public function getRelatedData($data): Collection
    {
        return $data->append([
            'amountWithCurrency',
            'paidLabel',
            'formatedDate'
        ]);
    }
}
