<?php

namespace App\Services;

use App\Repositories\Eloquent\FileRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    private $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function saveFile(Model $model, $file, $data = [])
    {
        $size = $file->getSize();
        $dir = strtolower(class_basename($model));

        $filePath = "{$dir}/{$model->id}";
        $extension = $file->getClientOriginalExtension();

        $filename = str_replace(
            ".$extension",
            "-". rand(11111, 9999) . ".$extension",
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
            'show_to_customer' => isset($data['show_to_customer']) ? $data['show_to_customer'] : 1, // todo zistit defaultne show_to_customer, lebo na frontende sa neda nastavovat
            'fileable_id'  => $model->id,
            'fileable_type'  => get_class($model),
            'file_type_id' => isset($data['file_type_id']) ? $data['file_type_id'] : 1, // todo zistit defaultne file_type_id, lebo na frontende sa neda nastavovat
            'user_id'   => Auth::id(),
        ]);
    }
}
