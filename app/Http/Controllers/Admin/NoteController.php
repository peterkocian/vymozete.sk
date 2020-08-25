<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy(int $id)
    {
        Note::findOrFail($id)->delete();
    }
}
