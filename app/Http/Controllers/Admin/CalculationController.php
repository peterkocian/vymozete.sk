<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalculationSaveRequest;
use App\Services\CalculationService;
use App\Services\ClaimService;
use App\Services\CurrencyService;
use Illuminate\Http\Response;

class CalculationController extends Controller
{
    protected $calculationService;
    protected $currencyService;
    protected $claimService;

    public function __construct(
        CalculationService $calculationService,
        CurrencyService $currencyService,
        ClaimService $claimService
    )
    {
        $this->calculationService = $calculationService;
        $this->currencyService = $currencyService;
        $this->claimService = $claimService;
    }

    public function getAllByClaimId(int $claim_id)
    {
        try {
            $currencyList = $this->currencyService->getDataForSelectbox();
            $result = $this->calculationService->calculationsByClaimId($claim_id);

            $claim = $this->claimService->get($claim_id);
            $trovy = $claim->getTrovy();
            $urok = $claim->getUrok();
            $summary = $claim->summary();
            $vymozene = $claim->getVymozene();
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return redirect()
                    ->route('admin.claims.calculations.allByClaimId', $claim['id'])
                    ->withFail(__('general.Delete failed') . ' ' . $e->getMessage());
            }
        }

        if (request()->ajax()) {
            return response()->json([
                'data' => $result
            ]);
        }

        return view('admin.claims.main', [
            'claim_id' => $claim_id,
            'data' => $result,
            'currencies' => $currencyList,
            'tab' => 'calculations',

            'payment_due_date' => $claim->payment_due_date,
            'amount_with_currency' => $claim->amountWithCurrency,
            'trovy' => Utils::twoDecimal($trovy),
            'trovyDPH' => Utils::twoDecimal($trovy * 1.2),
            'urok' => Utils::twoDecimal($urok),
            'summary' => Utils::twoDecimal($summary),
            'vymozene' => Utils::twoDecimal($vymozene),
            'provizia' => Utils::twoDecimal($vymozene * 0.2),
            'clientCashBack' => Utils::twoDecimal($vymozene * 0.8),
            'vymoct' => Utils::twoDecimal($summary - $vymozene),
        ]);
    }

    public function store(CalculationSaveRequest $request, int $claim_id)
    {
        $data = $request->validated();

        try {
            $result = $this->calculationService->saveCalculation($data, $claim_id);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('general.Create failed') . ' ' . $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            $currencyList = $this->currencyService->getDataForSelectbox();
            $result = $this->calculationService->get($calculation_id);
        } catch (\Exception $e) {
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.calculations.edit', [
            'data' => $result,
            'claim_id' => $claim_id,
            'currencies' => $currencyList,
        ]);
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
                    ->route('admin.claims.calculations.allByClaimId', $claim_id)
                    ->withSuccess(__('general.Deleted successfully'));
            }
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $calculation_id,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return redirect()
                    ->route('admin.claims.calculations.allByClaimId', $claim_id)
                    ->withFail(__('general.Delete failed') . ' ' . $e->getMessage());
            }
        }
    }

    public function togglePayed(int $claim_id, int $calculation_id)
    {
        try {
            $this->calculationService->togglePayed($calculation_id);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $calculation_id,
                    'message' => __('general.Updated successfully'),
                ], Response::HTTP_OK);
            } else {
                return redirect()
                    ->route('admin.claims.calculations.allByClaimId', $claim_id)
                    ->withSuccess(__('general.Updated successfully'));
            }
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $calculation_id,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return redirect()
                    ->route('admin.claims.calculations.allByClaimId', $claim_id)
                    ->withFail(__('general.Update failed') . ' ' . $e->getMessage());
            }
        }
    }
}
