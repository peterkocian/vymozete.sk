<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadAdminClaimFileRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Eloquent\FileTypeRepository;

class FileController extends Controller
{
    protected $fileTypeRepository;
    protected $fileService;

    public function __construct(FileTypeRepository $fileTypeRepository, FileService $fileService)
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
            'tab'       => 'documents'
        ]);
    }

    public function storeDocument(UploadAdminClaimFileRequest $request, int $claim_id)
//    public function storeDocument(\Illuminate\Http\Request $request, int $claim_id)
    {
        if ($request->ajax())
        {
            $data = $request->all();
            $files = $request->file('uploads');

            $claim = $this->claimRepository->get($claim_id);

            try {
                if ($files) {
                    foreach($files as $file) {
                        if ($file && $file->isValid()) {
                            $saved = $this->fileService->saveFile($claim, $file, $data);

//                            return response()->json([
//                                'success' => true,
//                                'id' => $saved->id,
//                                'message' => __('file.File successfully uploaded'),
//                            ], Response::HTTP_CREATED);
                        } else {
                            throw new \Exception('Subor nie je validny');
                        }
                    }

                    return response()->json([
                        'success' => true,
                        'id' => $saved->id,
                        'message' => __('file.File successfully uploaded'),
                    ], Response::HTTP_CREATED);
                } else {
                    throw new \Exception('Requestom neprisiel ziadny subor na ulozenie');
                }
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

    public function download($id)
    {
        $file = File::findOrFail($id);

        if (Storage::disk('uploads')->exists("/claim/{$file->fileable_id}/{$file->filename}")) {
            return response()->download(
                Storage::disk('uploads')->path("claim/{$file->fileable_id}/{$file->filename}")
            );
        }

        return back()
            ->withFail('Subor sa neda stiahnut, subor uz neexistuje');
        //todo ohandlovat stav, ze subor na disku neexistuje, ale v DB zaznam ano
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            $file = File::findOrFail($id);

            if (Storage::disk('uploads')->exists("/claim/{$file->fileable_id}/{$file->filename}")) {
                Storage::disk('uploads')->delete("claim/{$file->fileable_id}/{$file->filename}");

                $file->delete();

                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'message' => __('file.File successfully deleted'),
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => __('file.File doesnt exists')
                ], Response::HTTP_VERSION_NOT_SUPPORTED);
            }
        }
        //todo standard response
        return back()
            ->withFail('povoleny iba ajax request');
    }
}
