<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ClaimService;
use App\Services\FileService;

class ClaimController extends Controller
{
    const TAB_OVERVIEW = 'overview';
    const TAB_CREDITOR = 'creditor';
    const TAB_DEBTOR = 'debtor';

    private $claimService;
    private $fileService;

    public function __construct(
        ClaimService $claimService,
        FileService $fileService
    )
    {
        $this->claimService = $claimService;
        $this->fileService = $fileService;
    }

    public function index()
    {
        $result = $this->claimService->all();
        if (request()->ajax()) {
            return response()->json($result);
        }
        return view('admin.claims.index', ['data' => $result]);
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
            'files'     => $files['data'], //todo fileservice vracia zle data
            'tab'       => self::TAB_OVERVIEW
        ]);
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
