<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertySaveRequest;
use App\Http\Requests\UploadAdminClaimFileRequest;
use App\Repositories\ClaimRepositoryInterface;
use App\Repositories\Eloquent\FileTypeRepository;
use App\Services\CurrencyService;
use App\Services\NoteService;
use App\Services\PropertyService;
use App\Services\UploadService;

class ClaimController extends Controller
{
    private $claimRepository;
    private $fileTypeRepository;
    private $currencyRepository;
    private $propertyService;
    private $noteService;
    private $uploadService;

    public function __construct(
        ClaimRepositoryInterface $claimRepository,
        FileTypeRepository $fileTypeRepository,
        CurrencyService $currencyRepository,
        PropertyService $propertyService,
        NoteService $noteService,
        UploadService $uploadService
    )
    {
        $this->claimRepository = $claimRepository;
        $this->fileTypeRepository = $fileTypeRepository;
        $this->currencyRepository = $currencyRepository;
        $this->propertyService = $propertyService;
        $this->noteService = $noteService;
        $this->uploadService = $uploadService;
    }

    public function index()
    {
//        $claim = Claim::find(1);
//        dd($claim->debtor->entity->name);
        $result = $this->claimRepository->index();
//        dd($claims);
        if (request()->ajax()) {
            return response()->json($result);
        }
        return view('admin.claims.index', ['data' => $result]);
    }

    public function overview(int $claim_id)
    {
        $claim = $this->claimRepository->get($claim_id);
//        $claim->debtor = $claim->debtor->en;
//        $claim->creditor = $claim->creditor->entity;
//        dd($claim);
        return view('admin.claims.main', [
            'claim' => $claim,
            'tab' => 'overview'
        ]);
    }

    public function creditor(int $claim_id)
    {
        $claim = $this->claimRepository->get($claim_id);
        $creditor = $claim->creditor;
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $creditor,
            'tab' => 'creditor'
        ]);
    }

    public function debtor(int $claim_id)
    {
        $claim = $this->claimRepository->get($claim_id);
        $debtor = $claim->debtor;
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $debtor,
            'tab' => 'debtor'
        ]);
    }

    public function documents(int $claim_id)
    {
        $claim = $this->claimRepository->get($claim_id);
        $fileTypes = $this->fileTypeRepository->all();

        if (request()->ajax()) {
            return response()->json($claim->files);
        }
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $claim->files,
            'fileTypes' => $fileTypes,
            'tab' => 'documents'
        ]);
    }

    public function uploadFiles(UploadAdminClaimFileRequest $request, int $claim_id)
    {
        if ($request->ajax())
        {
            $data = $request->all();
            $file = $request->file('file');

            $claim = $this->claimRepository->get($claim_id);

            try {
                if ($file && $file->isValid()) {
                    $saved = $this->uploadService->saveFile($claim, $file, $data);

                    return response()->json([
                        'success' => true,
                        'id' => $saved->id
                    ], 200);
                } else {
                    throw new \Exception('Requestom neprisiel ziadny subor na ulozenie');
                }
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
        }

        return back()
            ->withFail('povoleny iba ajax request');
    }

    public function properties(int $claim_id)
    {
        $claim = $this->claimRepository->get($claim_id);
//        $currencies = $this->currencyRepository->all();
        $currencies = $this->currencyRepository->all();
        $properties = $this->propertyService->index($claim->properties);

        if (request()->ajax()) {
            return response()->json($properties);
        }
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $properties,
            'currencies' => $currencies,
            'tab' => 'properties'
        ]);
    }

    public function storeProperties(PropertySaveRequest $request, int $claim_id)
    {
        if ($request->ajax())
        {
            $data = $request->except('_token', '_method');

            try {
                $result = $this->propertyService->saveProperty($data, $claim_id);
            } catch (\Exception $e) {
                report($e);

                return response()->json([
                    'success' => false,
                    'message' => __('general.Create failed') . PHP_EOL . $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'success' => true,
                'id' => $result->id,
                'message' => __('general.Created successfully'),
            ], 200);
        }

        return back()
            ->withFail('povoleny iba ajax request');
    }
}
