<?php

namespace App\Repositories\Eloquent;

use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

// custom actions for property repository
class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    private $claimRepository;

    /**
     * PropertyRepository constructor.
     *
     * @param Property $model
     * @param ClaimRepository $claimRepository
     */
    public function __construct(
        Property $model,
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
     * @param $claim_id
     * @return Model
     */
    public function save(array $attributes, $claim_id): Model
    {
        $claim = $this->claimRepository->get($claim_id);
        $attributes['claim_id'] = $claim->id;
        $attributes['user_id'] = Auth::id();

        return $this->model->create($attributes);
    }

    public function getData(int $claim_id = null, array $searchParams = []): Builder // pretazena metoda z BaseRepository
    {
        return $this->claimRepository->get($claim_id)->properties()->getQuery();
    }

    public function getRelatedData($data): Collection
    {
        return $data->append([
            'amountWithCurrency'
        ]);
    }
}
