<?php

namespace App\Services;

use App\Helpers\SimpleTable;
use App\Repositories\ClaimRepositoryInterface;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileService
{
    private $fileRepository;
    private $claimRepository;

    public function __construct(FileRepositoryInterface $fileRepository,ClaimRepositoryInterface $claimRepository)
    {
        $this->fileRepository  = $fileRepository;
        $this->claimRepository = $claimRepository;
    }

    public function save($files, array $data, int $claim_id)
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

        return false;
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
            'show_to_customer'  => isset($data['show_to_customer']) ? $data['show_to_customer'] : 1, // todo zistit defaultne show_to_customer, lebo na frontende sa neda nastavovat
            'fileable_id'       => $model->id,
            'fileable_type'     => get_class($model),
            'file_type_id'      => isset($data['file_type_id']) ? $data['file_type_id'] : 1, // todo zistit defaultne file_type_id, lebo na frontende sa neda nastavovat
            'user_id'   => Auth::id(),
        ]);
    }

    public function filesByClaimId(int $claim_id)
    {
        $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
        $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;
        $pagination = request('pagination') ?? $this->fileRepository->getPagination();

        //sort data
        $query = $this->fileRepository->getData($claim_id)->orderBy($sortKey,$sortDirection);

        if ($pagination) {
            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;

            $paginate = $query->paginate($rows);
            $data['data'] = $this->fileRepository->getRelatedData($paginate)->toArray();
            $pag = $paginate->toArray();
            unset($pag['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
            $data['pagination'] = $pag;
        } else {
            $data = $this->fileRepository->getRelatedData($query->get())->toArray();
        }

        return $data;
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
