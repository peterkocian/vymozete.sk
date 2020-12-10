<?php

namespace App\Repositories\Eloquent;

use App\Models\Claim;
use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

// custom actions for property repository
class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    /**
     * PropertyRepository constructor.
     *
     * @param Property $model
     */
    public function __construct(Property $model)
    {
        parent::__construct($model);
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
        $claim = Claim::findOrFail($claim_id);
        $attributes['claim_id'] = $claim->id;
        $attributes['user_id'] = Auth::id();

        return $this->model->create($attributes);
    }

    public function getData(int $claim_id = null, array $searchParams = []): Builder // pretazena metoda z BaseRepository
    {
        return Claim::findOrFail($claim_id)->properties()->getQuery();
    }

    public function getRelatedData($data): Collection
    {
        return $data->append([
            'amountWithCurrency'
        ]);
    }
}
