<?php

namespace App\Services;

use App\Repositories\CalendarRepositoryInterface;
use App\Repositories\ClaimRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarService
{
    private $calendarRepository;
    private $claimRepository;

    public function __construct(
        CalendarRepositoryInterface $calendarRepository,
        ClaimRepositoryInterface $claimRepository
    )
    {
        $this->calendarRepository = $calendarRepository;
        $this->claimRepository = $claimRepository;
    }

    public function all()
    {
//        return $this->calendarRepository->all();
    }

    public function eventsByClaimId(int $claim_id)
    {
        try {
            $result = $this->calendarRepository->findByClaimId($claim_id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return [
            'events' => $result['events'],
            'sum' => $result['sum']
        ];
    }

    public function saveEvents(array $data, int $claim_id)
    {
        $events = [];

        $dates   = $data['dates'];
        $amounts = $data['amounts'];

        foreach ($dates as $index => $date) {
            $amount = 0;
            if (isset($amounts[$index])) {
                $amount = $amounts[$index];
            }

            array_push($events,[
                'date' => Carbon::parse($date)->toDate(),
                'amount' => $amount,
                'claim_id' => $claim_id,
                'currency_id' => 1,
                'user_id' => Auth::id()
            ]);
        }

        DB::beginTransaction();

        try {
            //vymaze vsetky existujuce zaznamy
            $this->calendarRepository->deleteAllById($claim_id);
            //ulozi nove, prave poslane requestom
            $result = $this->calendarRepository->save($events, $claim_id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new \Exception($e->getMessage());
        }

        return $result;
    }
}
