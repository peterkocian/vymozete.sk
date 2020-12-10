<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadAdminClaimFileRequest;
use App\Services\FileService;
use Illuminate\Http\Response;
use App\Repositories\Eloquent\FileTypeRepository;

class FileController extends Controller
{
    const TAB_DOCUMENTS = 'documents';

    protected $fileTypeRepository;
    protected $fileService;

    public function __construct(
        FileTypeRepository $fileTypeRepository,
        FileService $fileService
    )
    {
        $this->fileTypeRepository = $fileTypeRepository;
        $this->fileService = $fileService;
    }

    public function getAllByClaimId(int $claim_id)
    {
        $result = $this->fileService->filesByClaimId($claim_id);
        $fileTypes = $this->fileTypeRepository->getDataForSelectbox();

        if (request()->ajax()) {
            return response()->json($result);
        }
        return view('admin.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $result,
            'fileTypes' => $fileTypes,
            'tab'       => self::TAB_DOCUMENTS,
        ]);
    }

    public function storeDocument(UploadAdminClaimFileRequest $request, int $claim_id)
    {
        if ($request->ajax())
        {
            $data = $request->validated();
            $files = $request->file('uploads');

            try {
                $this->fileService->save($files, $claim_id, $data);

                return response()->json([
                    'success' => true,
                    'message' => __('file.File successfully uploaded'),
                ], Response::HTTP_CREATED);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            }
        }

        return back()
            ->withFail('povoleny iba ajax request');
    }

    public function download(int $id)
    {
        try {
            $res = $this->fileService->download($id);
            return response()->download($res);
        } catch (\Exception $e) {
            return back()
                ->withFail(__('file.File cannot be downloaded') .' '. $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        if (request()->ajax()) {
            try {
                $this->fileService->delete($id);

                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'message' => __('file.File successfully deleted'),
                ], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => __('file.File delete failed') .' '. $e->getMessage()
                ], Response::HTTP_VERSION_NOT_SUPPORTED);
            }
        }

        return back()
            ->withFail('povoleny iba ajax request');
    }
}
