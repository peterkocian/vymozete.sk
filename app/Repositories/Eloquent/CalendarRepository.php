<?php

namespace App\Repositories\Eloquent;

use App\Models\Calendar;
use App\Models\Claim;
use App\Repositories\CalendarRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CalendarRepository extends BaseRepository implements CalendarRepositoryInterface
{
    /**
     * CalendarRepository constructor.
     *
     * @param Calendar $model
     */
    public function __construct(Calendar $model)
    {
        parent::__construct($model);
    }

    /**
     * Create an entity.
     *
     * @param array $attributes
     * @param int $claim_id
     * @return Collection
     */
    public function save(array $attributes, int $claim_id): Collection
    {
        $claim = Claim::findOrFail($claim_id);
//        $attributes['claim_id'] = $claim->id;
//        $attributes['user_id'] = Auth::id();

        return $claim->calendars()->createMany($attributes);
    }

    public function claim(int $claim_id)
    {
        return Claim::find($claim_id);
    }

    public function deleteAllById(int $claim_id): int
    {
        $claim = Claim::findOrFail($claim_id);
//        $attributes['claim_id'] = $claim->id;
//        $attributes['user_id'] = Auth::id();

        return $claim->calendars()->delete();
    }
}
