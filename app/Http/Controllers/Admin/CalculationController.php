<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculationSaveRequest;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Services\CalculationService;
use App\Services\ClaimService;
use Illuminate\Http\Response;

class CalculationController extends Controller
{
    protected $calculationService;
    protected $currencyRepository;
    protected $claimService;

    public function __construct(CalculationService $calculationService, CurrencyRepository $currencyRepository, ClaimService $claimService)
    {
        $this->calculationService = $calculationService;
        $this->currencyRepository = $currencyRepository;
        $this->claimService = $claimService;
    }

    public function index()
    {
        // return Note::all();
    }

    public function getAllByClaimId(int $claim_id)
    {
        $currencies = $this->currencyRepository->getDataForSelectbox();
        $result = $this->calculationService->calculationsByClaimId($claim_id);

        $claim = $this->claimService->get($claim_id);
        $trovy = $this->calculationService->getTrovy($claim);
        $summary = $this->calculationService->summery($claim, $trovy * 1.2, 0);

        if (request()->ajax()) {
            return response()->json($result);
        }
        return view('admin.claims.main', [
            'claim_id' => $claim_id,
            'data' => $result,
            'currencies' => $currencies,
            'tab' => 'calculations',

            'payment_due_date' => $claim->paymentDueDate,
            'amount_with_currency' => $claim->amountWithCurrency,
            'trovy' => $trovy,
            'trovyDPH' => $trovy * 1.2,
            'summary' => $summary

        ]);
    }

    public function store(CalculationSaveRequest $request, int $claim_id)
    {
        $data = $request->validated();

        try {
            $result = $this->calculationService->saveCalculation($data, $claim_id);
        } catch (\Exception $e) {
            report($e);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('general.Create failed') . ' ' . $e->getMessage(),
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            } else {
                return redirect()
                    ->route('admin.claims.calculations.allByClaimId', $claim_id)
                    ->withFail(__('general.Create failed') . ' ' . $e->getMessage());
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $result->id,
                'message' => __('general.Created successfully'),
            ], Response::HTTP_OK);
        } else {
            return back()
                ->withSuccess(__('general.Created successfully'));
        }
    }

    public function edit(int $claim_id, int $calculation_id)
    {
        try {
            $result = $this->calculationService->get($calculation_id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.calculations.edit', ['data' => $result, 'claim_id' => $claim_id]);
    }

    public function update(CalculationSaveRequest $request, int $claim_id, int $calculation_id)
    {
        $data = $request->validated();

        try {
            $this->calculationService->updateCalculation($data, $calculation_id);

            return redirect()
                ->route('admin.claims.calculations.allByClaimId', $claim_id)
                ->withSuccess(__('general.Updated successfully'));
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Update failed') . ' ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(int $claim_id, int $calculation_id)
    {
        try {
            $this->calculationService->destroy($calculation_id);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $calculation_id,
                    'message' => __('general.Deleted successfully'),
                ], Response::HTTP_OK);
            } else {
                return redirect()
                    ->route('admin.claims.notes.allByClaimId', $claim_id)
                    ->withSuccess(__('general.Deleted successfully'));
            }
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $calculation_id,
                    'message' => $e->getMessage(),
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            } else {
                return redirect()
                    ->route('admin.claims.notes.allByClaimId', $claim_id)
                    ->withFail(__('general.Delete failed') . ' ' . $e->getMessage());
            }
        }
    }
}
