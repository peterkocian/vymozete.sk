<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Eloquent\FileTypeRepository;
use App\Services\ClaimService;
use App\Services\FileService;
use App\Services\NoteService;
use App\Services\PropertyService;

class ClaimController extends Controller
{
    private $claimService;
    private $fileTypeRepository;
    private $currencyRepository;
    private $propertyService;
    private $noteService;
    private $fileService;

    public function __construct(
        ClaimService $claimService,
        FileTypeRepository $fileTypeRepository,
        CurrencyRepository $currencyRepository,
        PropertyService $propertyService,
        NoteService $noteService,
        FileService $fileService
    )
    {
        $this->claimService = $claimService;
        $this->fileTypeRepository = $fileTypeRepository;
        $this->currencyRepository = $currencyRepository;
        $this->propertyService = $propertyService;
        $this->noteService = $noteService;
        $this->fileService = $fileService;
    }

    public function index()
    {
        $result = $this->claimService->index();
        if (request()->ajax()) {
            return response()->json($result);
        }
        return view('admin.claims.index', ['data' => $result]);
    }

    public function overview(int $claim_id)
    {
        $claim = $this->claimService->get($claim_id);

        return view('admin.claims.main', [
            'claim_id'  => $claim_id,
            'claim'     => $claim,
            'tab'       => 'overview'
        ]);
    }

    public function creditor(int $claim_id)
    {
        $creditor = $this->claimService->get($claim_id)->creditor;   //todo
        return view('admin.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $creditor,
            'tab'       => 'creditor'
        ]);
    }

    public function debtor(int $claim_id)
    {
        $debtor = $this->claimService->get($claim_id)->debtor;   //todo
        return view('admin.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $debtor,
            'tab'       => 'debtor'
        ]);
    }
}
