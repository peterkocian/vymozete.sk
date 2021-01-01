<?php

namespace App\Services;

use App\Models\File;
use App\Models\FileType;
use App\Repositories\ClaimRepositoryInterface;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileService
{
    private $fileRepository;
    private $claimRepository;
    private $simpleTableService;

    public function __construct(
        FileRepositoryInterface $fileRepository,
        ClaimRepositoryInterface $claimRepository,
        SimpleTableService $simpleTableService
    )
    {
        $this->fileRepository  = $fileRepository;
        $this->claimRepository = $claimRepository;
        $this->simpleTableService = $simpleTableService;
    }

    public function save($files, int $claim_id, array $data = null)
    {
        $claim = $this->claimRepository->get($claim_id);

        if ($files) {
            foreach($files as $file) {
                if ($file && $file->isValid()) {
                    $this->saveFile($claim, $file, $data);
                } else {
                    throw new \Exception(__('file.File is invalid'));
                }
            }
        } else {
            throw new \Exception(__('file.No file to save'));
        }
    }

    public function saveFile(Model $model, $file, $data = [])
    {
        $size = $file->getSize();
        $dir = strtolower(class_basename($model));

        $filePath = "{$dir}/{$model->id}";
        $extension = $file->getClientOriginalExtension();

        $filename = str_replace(
            ".$extension",
            "-". rand(11111, 99999) . ".$extension",
            $file->getClientOriginalName()
        );

        if(Storage::disk('uploads')->put($filePath.'/'.$filename,  \Illuminate\Support\Facades\File::get($file))) {
            return $this->saveFileToDatabase($file, $filename, $model, $size, $filePath, $data);
        }
    }

    public function saveFileToDatabase($file, $filename, $model, $size, $filePath, $data)
    {
        return $this->fileRepository->create([
            'name'      => isset($data['filename']) ? $data['filename'] : $file->getClientOriginalName(),
            'filename'  => $filename,
            'mime'      => $file->getClientMimeType(),
            'ext'       => $file->getClientOriginalExtension(),
            'size'      => $size,
            'path'      => $filePath,
            'show_to_customer'  => isset($data['show_to_customer']) ? $data['show_to_customer'] : File::SHOW_TO_CUSTOMER_TRUE,
            'fileable_id'       => $model->id,
            'fileable_type'     => get_class($model),
            'file_type_id'      => isset($data['file_type_id']) ? $data['file_type_id'] : FileType::DEFAULT_TYPE_ID_UPLOAD,
            'user_id'   => Auth::id(),
        ]);
    }

    public function filesByClaimId(int $claim_id)
    {
        return $this->simpleTableService->processSimpleTableData($this->fileRepository, $claim_id, true);
    }

    public function download(int $id)
    {
        $file = $this->fileRepository->get($id);
        if (!$file) {
            throw new \Exception('Súbor neexistuje v DB.');
        }

        if ($this->checkFileOnDisk("/claim/{$file->fileable_id}/{$file->filename}")) {
            return Storage::disk('uploads')->path("claim/{$file->fileable_id}/{$file->filename}");
        } else {
            throw new \Exception(__('file.File doesnt exists'));
        }
    }

    public function delete(int $id)
    {
        $file = $this->fileRepository->get($id);
        if (!$file) {
            throw new \Exception(__('file.File doesnt exists'));
        }

        if ($this->checkFileOnDisk("/claim/{$file->fileable_id}/{$file->filename}")) {
            Storage::disk('uploads')->delete("claim/{$file->fileable_id}/{$file->filename}");

            $file->delete();
        } else {
            throw new \Exception(__('file.File doesnt exists'));
        }
    }

    private function checkFileOnDisk(string $path)
    {
        return Storage::disk('uploads')->exists($path);
    }
}
