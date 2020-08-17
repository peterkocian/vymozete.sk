<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadService
{
//    private $userRepository;
//
//    public function __construct(UserRepositoryInterface $userRepository)
//    {
//        $this->userRepository = $userRepository;
//    }

    public function saveFile($model, $file, $data)
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
            return $this->addFileToDatabase($file, $filename, $model, $size, $filePath, $data);
        }

        return false;
    }

    public function addFileToDatabase($file, $filename, $model, $size, $filePath, $data)
    {
        return File::create([
            'name'      => $data['filename'],
            'filename'  => $filename,
            'mime'      => $file->getClientMimeType(),
            'ext'       => $file->getClientOriginalExtension(),
            'size'      => $size,
            'path'      => $filePath,
            'show_to_customer' => $data['show_to_customer'] ?? null,
            'fileable_id'  => $model->id,
            'fileable_type'  => get_class($model),
            'file_type_id' => $data['file_type_id'],
            'user_id'   => Auth::id(),
        ]);
    }
}
