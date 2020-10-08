<?php

namespace App\Services;

use App\Repositories\CalendarRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CalendarService
{
    private $calendarRepository;

    public function __construct(CalendarRepositoryInterface $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function all()
    {
//        return $this->calendarRepository->all();
    }

    public function eventsByClaimId(int $claim_id)
    {
        $claim = $this->calendarRepository->claim($claim_id);
        return $claim->calendars;
//        $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
//        $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;
//        $pagination = request('pagination') ?? $this->noteRepository->getPagination();
//
//        //sort data
//        $query = $this->noteRepository->getData($claim_id)->orderBy($sortKey,$sortDirection);
//
//        if ($pagination) {
//            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;
//
//            $paginate = $query->paginate($rows);
////            $data['data'] = $this->noteRepository->getRelatedData($paginate);
//            $data['data'] = $paginate->items();
//            $pag = $paginate->toArray();
//            unset($pag['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
//            $data['pagination'] = $pag;
//        } else {
//            $data = $query->get();
//        }
//
//        return $data;
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
                'date' => $date,
                'amount' => $amount,
                'claim_id' => $claim_id,
                'currency_id' => 1,
                'user_id' => Auth::id()
            ]);
        }

        try {
            $result = $this->calendarRepository->save($events, $claim_id);
        } catch (\Exception $e) {
//            Log::info($e->getMessage());
            throw new \Exception($e->getMessage());
        }

        return $result;
    }
}
