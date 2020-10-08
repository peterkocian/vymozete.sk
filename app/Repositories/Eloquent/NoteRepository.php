<?php

namespace App\Repositories\Eloquent;

use App\Models\Claim;
use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
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
     * @param int $claim_id
     * @return Model
     */
    public function save(array $attributes, int $claim_id): Model
    {
        $claim = Claim::findOrFail($claim_id);
        $attributes['claim_id'] = $claim->id;
        $attributes['user_id'] = Auth::id();

        return $this->model->insert($attributes);
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

            if ($note) {
                $note->update($attributes);

                return $note;
            }
        }

        throw new \Exception('Nezname id');
    }

    public function getData(int $claim_id = null): Builder // pretazena metoda z BaseRepository
    {
        return Claim::find($claim_id)->notes()->getQuery();
    }
}
