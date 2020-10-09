<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SplatkySaveRequest;
use App\Services\CalculationService;
use App\Services\CalendarService;
use App\Services\ClaimService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    protected $calculationService;
    protected $calendarService;
    protected $claimService;

    public function __construct(CalculationService $calculationService, ClaimService $claimService, CalendarService $calendarService)
    {
        $this->calculationService = $calculationService;
        $this->calendarService = $calendarService;
        $this->claimService = $claimService;
    }

    public function index(int $claim_id)
    {
        // return all();
//        $claim = $this->claimService->get($claim_id);
//        $events = $this->calendarService->all();
//
//        return view('admin.claims.main', [
//            'claim_id' => $claim_id,
//            'amount'   => $claim['amount'],
//            'events'   => $events,
//            'tab'      => 'calendar',
//        ]);
    }

    public function getAllByClaimId(int $claim_id)
    {
        $claim = $this->claimService->get($claim_id);
        $events = $this->calendarService->eventsByClaimId($claim_id);


        return view('admin.claims.main', [
            'claim_id' => $claim_id,
            'amount'   => $claim['amount'],
            'events'   => $events,
            'tab'      => 'calendar',
        ]);
    }

    public function store(SplatkySaveRequest $request, int $claim_id)
    {
        $data = $request->all();

        try {
            $result = $this->calendarService->saveEvents($data, $claim_id);
        } catch (\Exception $e) {
//            report($e);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('general.Create failed') . ' ' . $e->getMessage(),
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            } else {
                return redirect()
                    ->route('admin.claims.notes.allByClaimId', $claim_id)
                    ->withFail(__('general.Create failed') . ' ' . $e->getMessage());
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => null,
                'message' => __('general.Created successfully'),
            ], Response::HTTP_OK);
        } else {
            return back()
                ->withSuccess(__('general.Created successfully'));
        }
    }
}
