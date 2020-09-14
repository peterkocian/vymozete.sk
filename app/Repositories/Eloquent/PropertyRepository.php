<?php

namespace App\Repositories\Eloquent;

use App\Helpers\SimpleTable;
use App\Models\Claim;
use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
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

    public function propertyByClaimId(int $claim_id)
    {
        return $this->getTableDataa($this->model, $claim_id);
    }

    public function getTableDataa(Model $model, int $claim_id)
    {
        $pagination = request('pagination') ?? $model::INDEX_VIEW_PAGINATION;

        if ($model)
        {
            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;
            $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
            $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;

            $data = $model::where('claim_id', $claim_id)->orderBy($sortKey, $sortDirection);

//            dd($data->get()->toArray());

            if ($pagination) {
                $paginate = $data->paginate($rows);
                $arr = $paginate->toArray();
                $result['data'] = $arr['data'];
                unset($arr['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
                $result['pagination'] = $arr;
            } else {
                $result = $data->get()->toArray();
            }

            return $result;
        }
    }
}
