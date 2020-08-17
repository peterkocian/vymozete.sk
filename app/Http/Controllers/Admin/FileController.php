<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download($id)
    {
        $file = File::findOrFail($id);

        if (Storage::disk('uploads')->exists("/claim/{$file->fileable_id}/{$file->filename}")) {
            return response()->download(
                Storage::disk('uploads')->path("claim/{$file->fileable_id}/{$file->filename}")
            );
        }

        return back()
            ->withFail('Subor sa neda stiahnut');
    }

    public function destroy($id)
    {
        //todo
//        if (request()->ajax()) {
//
//        }
        $file = File::findOrFail($id);

        if (Storage::disk('uploads')->exists("/claim/{$file->fileable_id}/{$file->filename}")) {
            Storage::disk('uploads')->delete("claim/{$file->fileable_id}/{$file->filename}");

            $file->delete();

            return back()
                ->withSuccess('Vymazany file');
        } else {
            //todo file neexistuje na disku, neda sa vymazat
            dd('todo file neexistuje na disku, neda sa vymazat');
        }
    }
}
