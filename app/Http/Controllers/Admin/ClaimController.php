<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ClaimStatusService;
use App\Services\ClaimTypeService;
use App\Services\ClaimService;
use App\Services\FileService;
use PDF;

class ClaimController extends Controller
{
    const TAB_OVERVIEW = 'overview';
    const TAB_CREDITOR = 'creditor';
    const TAB_DEBTOR = 'debtor';

    private $claimService;
    private $fileService;
    private $claimTypeService;
    private $claimStatusService;

    public function __construct(
        ClaimService $claimService,
        FileService $fileService,
        ClaimTypeService $claimTypeService,
        ClaimStatusService $claimStatusService
    )
    {
        $this->claimService = $claimService;
        $this->fileService = $fileService;
        $this->claimTypeService = $claimTypeService;
        $this->claimStatusService = $claimStatusService;
    }

    public function index()
    {
        try {
            $result = $this->claimService->all();
            $debtors = $this->claimService->getAllDebtors($result);
            $creditors = $this->claimService->getAllCreditors($result);
            $claimTypes = $this->claimTypeService->getDataForSelectbox();
            $claimStatus = $this->claimStatusService->getDataForSelectbox();
        } catch (\Exception $e) {
            request()->session()->now('fail', $e->getMessage());

//            if (request()->ajax()) {
//                return response()->json([
//                    'success' => false,
//                    'message' => $e->getMessage(),
//                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
//            }
        }

        if (request()->ajax()) {
            return response()->json([
                'data' => $result ?? [],
                'creditors' => $creditors ?? [],
                'debtors' => $debtors ?? [],
            ]);
        }
        return view('admin.claims.index', [
            'data' => $result ?? [],
            'creditors' => $creditors ?? [],
            'debtors' => $debtors ?? [],
            'claimTypes' => $claimTypes ?? [],
            'claimStatus' => $claimStatus ?? [],
        ]);
    }

    public function overview(int $claim_id)
    {
        $claim    = $this->claimService->get($claim_id);
        $creditor = $this->claimService->getCreditor($claim_id);
        $debtor   = $this->claimService->getDebtor($claim_id);
        $files    = $this->fileService->filesByClaimId($claim_id);

        return view('admin.claims.main', [
            'claim_id'  => $claim_id,
            'claim'     => $claim,
            'debtor'    => $debtor,
            'creditor'  => $creditor,
            'files'     => $files['data'],
            'tab'       => self::TAB_OVERVIEW
        ]);
    }

    public function export(int $claim_id)
    {
        $claim = $this->claimService->get($claim_id);

        if (request('export')) {
            if (request('export') === 'pu') {
                $pdf = PDF::loadView('pdf.PU', compact('claim'));
//                return view('pdf.PU', [
//                    'claim'  => $claim,
//                ]);
                return $pdf->stream();
//                return $pdf->download('xxx.pdf');
            }
            elseif (request('export') === 'sk_fo') {
                $pdf = PDF::loadView('pdf.SK_FO', compact('claim'));
//                return view('pdf.SK_FO', [
//                    'claim'  => $claim,
//                ]);
                return $pdf->stream();
//                return $pdf->download('xxx.pdf');
            }
            elseif (request('export') === 'pz_ff') {
                $pdf = PDF::loadView('pdf.PZ_FF', compact('claim'));
//                return view('pdf.PZ_FF', [
//                    'claim'  => $claim,
//                ]);
                return $pdf->stream();
//                return $pdf->download('xxx.pdf');
            }
        }
    }

    public function creditor(int $claim_id)
    {
        $creditor = $this->claimService->getCreditor($claim_id);

        return view('admin.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $creditor,
            'tab'       => self::TAB_CREDITOR
        ]);
    }

    public function debtor(int $claim_id)
    {
        $debtor = $this->claimService->getDebtor($claim_id);

        return view('admin.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $debtor,
            'tab'       => self::TAB_DEBTOR
        ]);
    }
}
