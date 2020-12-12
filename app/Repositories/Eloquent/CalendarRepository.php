<?php

namespace App\Repositories\Eloquent;

use App\Models\Calendar;
use App\Repositories\CalendarRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CalendarRepository extends BaseRepository implements CalendarRepositoryInterface
{
    private $claimRepository;

    /**
     * CalendarRepository constructor.
     *
     * @param Calendar $model
     * @param ClaimRepository $claimRepository
     */
    public function __construct(
        Calendar $model,
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
     * @return Collection
     */
    public function save(array $attributes, int $claim_id): Collection
    {
        $claim = $this->claimRepository->get($claim_id);
        return $claim->calendars()->createMany($attributes);
    }

    public function findByClaimId(int $claim_id)
    {
        $claim = $this->claimRepository->get($claim_id);
        return [
            'events' => $claim->calendars,
            'sum' => $claim->calendars->sum('amount')
        ];
    }

    public function deleteAllById(int $claim_id): int
    {

        $claim = $this->claimRepository->get($claim_id);

        return $claim->calendars()->delete();
    }
}
