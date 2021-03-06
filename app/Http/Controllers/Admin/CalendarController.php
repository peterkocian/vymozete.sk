<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Requests\SplatkySaveRequest;
use App\Services\CalendarService;
use App\Services\ClaimService;
use Illuminate\Http\Response;

class CalendarController extends Controller
{
    protected $calendarService;
    protected $claimService;

    public function __construct(
        ClaimService $claimService,
        CalendarService $calendarService
    )
    {
        $this->calendarService = $calendarService;
        $this->claimService = $claimService;
    }

    public function getAllByClaimId(int $claim_id)
    {
        try {
            $claim = $this->claimService->get($claim_id);
            $data = $this->calendarService->eventsByClaimId($claim_id);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withFail(__('general.Find failed') . ' ' . $e->getMessage());
        }

        return view('admin.claims.main', [
            'claim_id' => $claim_id,
            'amount'   => Utils::twoDecimal($claim->summary()),
            'currency' => $claim['currency']['symbol'],
            'events'   => $data['events'],
            'sum'      => Utils::twoDecimal($data['sum']),
            'tab'      => 'calendar',
        ]);
    }

    public function store(SplatkySaveRequest $request, int $claim_id)
    {
        $data = $request->validated();

        try {
            $this->calendarService->saveEvents($data, $claim_id);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('general.Create failed') . ' ' . $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return redirect()
                    ->route('admin.claims.calendar.allByClaimId', $claim_id)
                    ->withFail(__('general.Create failed') . ' ' . $e->getMessage());
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('general.Created successfully'),
            ], Response::HTTP_OK);
        } else {
            return back()
                ->withSuccess(__('general.Created successfully'));
        }
    }
}
