<?php

namespace App\Repositories\Eloquent;

use App\Helpers\SimpleTable;
use App\Models\Claim;
use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// custom actions for note repository
class NoteRepository extends BaseRepository implements NoteRepositoryInterface
{
    /**
     * NoteRepository constructor.
     *
     * @param Note $model
     */
    public function __construct(Note $model)
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

    public function update(array $attributes, int $id): Model
    {
        if ($id) {
            try {
                $note = $this->model->findOrFail($id);
            } catch (\Exception $e) {
                report($e);
                throw new \Exception('Poznamku sa nepodarilo najst.'. $e->getMessage());
            }
        }

        if ($note) {
            $note->update($attributes);

            return $note;
        }
    }

    public function notesByClaimId(int $claim_id)
    {
        return $this->getTableDataa($this->model, $claim_id);
    }

    //todo
    public function getTableDataa(Model $model, int $claim_id)
    {
        $pagination = request('pagination') ?? $model::INDEX_VIEW_PAGINATION;

        if ($model)
        {
            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;
            $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
            $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;

            $data = $model::where('claim_id', $claim_id)->orderBy($sortKey, $sortDirection);

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
