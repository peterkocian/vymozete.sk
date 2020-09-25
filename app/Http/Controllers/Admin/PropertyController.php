<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertySaveRequest;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Services\PropertyService;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    protected $propertyService;
//    protected $claimService; vymazat
    protected $currencyRepository;

    public function __construct(PropertyService $propertyService, CurrencyRepository $currencyRepository
//        , ClaimService $claimService vymazat
    )
    {
        $this->propertyService = $propertyService;
//        $this->claimService = $claimService; vymazat
        $this->currencyRepository = $currencyRepository;
    }

    public function index()
    {
        // return Property::all();
    }

    public function getAllByClaimId(int $claim_id)
    {
        $currencies = $this->currencyRepository->getDataForSelectbox();
        $result = $this->propertyService->propertyByClaimId($claim_id);

        if (request()->ajax()) {
            return response()->json($result);
        }
        return view('admin.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $result,
            'currencies' => $currencies,
            'tab'       => 'properties'
        ]);
    }

    public function store(PropertySaveRequest $request, int $claim_id)
    {
        if ($request->ajax())
        {
            $data = $request->all();

            try {
                $result = $this->propertyService->saveProperty($data, $claim_id);
            } catch (\Exception $e) {
                report($e);

                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => __('general.Create failed') . ' ' . $e->getMessage(),
                    ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
                } else {
                    return redirect()
                        ->route('admin.claims.properties.allByClaimId', $claim_id)
                        ->withFail(__('general.Create failed') . ' ' . $e->getMessage());
                }
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $result->id,
                    'message' => __('general.Created successfully'),
                ], Response::HTTP_CREATED);
            } else {
                return back()
                    ->withSuccess(__('general.Created successfully'));
            }
        }
    }

    public function destroy(int $claim_id, int $property_id)
    {
        try {
            $this->propertyService->destroy($property_id);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $property_id,
                    'message' => __('general.Deleted successfully'),
                ], 200);
            } else {
                return redirect()
                    ->route('admin.claims.properties.allByClaimId', $claim_id)
                    ->withSuccess(__('general.Deleted successfully'));
            }
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $property_id,
                    'message' => $e->getMessage(),
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            } else {
                return redirect()
                    ->route('admin.claims.properties.allByClaimId', $claim_id)
                    ->withFail(__('general.Delete failed') . ' ' . $e->getMessage());
            }
        }
    }
}
