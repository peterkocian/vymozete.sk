<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadAdminClaimFileRequest;
use App\Repositories\ClaimRepositoryInterface;
use App\Repositories\FileTypeRepositoryInterface;
use App\Services\UploadService;

class ClaimController extends Controller
{
    private $claimRepository;
    private $fileTypeRepository;
    protected $upload;

    public function __construct(ClaimRepositoryInterface $claimRepository, FileTypeRepositoryInterface $fileTypeRepository, UploadService $upload)
    {
        $this->claimRepository = $claimRepository;
        $this->fileTypeRepository = $fileTypeRepository;
        $this->upload = $upload;
    }

    public function index()
    {
//        $claim = Claim::find(1);
//        dd($claim->debtor->entity->name);
        $claims = $this->claimRepository->index();
//        dd($claims);
        return view('admin.claims.index', ['data' => $claims]);
    }

    public function overview(int $id)
    {
        $claim = $this->claimRepository->get($id);
//        $claim->debtor = $claim->debtor->en;
//        $claim->creditor = $claim->creditor->entity;
//        dd($claim);
        return view('admin.claims.main', [
            'claim' => $claim,
            'tab' => 'overview'
        ]);
    }

    public function creditor(int $id)
    {
        $claim = $this->claimRepository->get($id);
        $creditor = $claim->creditor;
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $creditor,
            'tab' => 'creditor'
        ]);
    }

    public function debtor(int $id)
    {
        $claim = $this->claimRepository->get($id);
        $debtor = $claim->debtor;
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $debtor,
            'tab' => 'debtor'
        ]);
    }

    public function documents(int $id)
    {
        $claim = $this->claimRepository->get($id);
        $files = $claim->files;
        $fileTypes = $this->fileTypeRepository->all();

        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $files,
            'fileTypes' => $fileTypes,
            'tab' => 'documents'
        ]);
    }

    public function uploadFiles(UploadAdminClaimFileRequest $request, int $id)
    {
        if ($request->ajax())
        {
            $data = $request->except(['file']);
            $file = $request->file('file');

            $claim = $this->claimRepository->get($id);

            if ($file && $file->isValid()) {
                $saved = $this->upload->saveFile($claim, $file, $data);

                return response()->json([
                    'success' => true,
                    'id' => $saved->id
                ], 200);
            }

            return response()->json([
                'success' => false
            ], 500);
        }

        return back()
            ->withFail('povoleny iba ajax request');
    }
}
