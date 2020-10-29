<?php

namespace App\Repositories\Eloquent;

use App\Models\Calculation;
use App\Models\Claim;
use App\Repositories\CalculationRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

// custom actions for calculation repository
class CalculationRepository extends BaseRepository implements CalculationRepositoryInterface
{
    /**
     * NoteRepository constructor.
     *
     * @param Calculation $model
     */
    public function __construct(Calculation $model)
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

        return $this->model->create($attributes);
    }

    public function update(array $attributes, int $id): Model // todo je mozne pouzit update metodu z BaseRepository
    {
        if ($id) {
            try {
                $calculation = $this->model->findOrFail($id);
            } catch (\Exception $e) {
                report($e);
                throw new \Exception('calculation sa nepodarilo najst.'. $e->getMessage());
            }

            if ($calculation) {
                $calculation->update($attributes);

                return $calculation;
            }
        }

        throw new \Exception('Nezname id');
    }

    public function getData(int $claim_id = null): Builder // pretazena metoda z BaseRepository
    {
        return Claim::find($claim_id)->calculations()->getQuery();
    }

    public function getRelatedData($data): Collection
    {
        return $data->append([
            'amountWithCurrency',
            'paidLabel'
        ]);
    }
}
