<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteSaveRequest;
use App\Services\NoteService;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    protected $noteService;

    public function __construct(
        NoteService $noteService
    )
    {
        $this->noteService = $noteService;
    }

    public function getAllByClaimId(int $claim_id)
    {
        $result = $this->noteService->notesByClaimId($claim_id);

        if (request()->ajax()) {
            return response()->json([
                'data' => $result
            ]);
        }
        return view('admin.claims.main', [
            'claim_id' => $claim_id,
            'data' => $result,
            'tab' => 'notes'
        ]);
    }

    public function store(NoteSaveRequest $request, int $claim_id)
    {
        $data = $request->validated();

        try {
            $result = $this->noteService->saveNote($data, $claim_id);
        } catch (\Exception $e) {
            report($e);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('general.Create failed') . ' ' . $e->getMessage(),
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            } else {
                return redirect()
                    ->route('admin.claims.notes.allByClaimId', $claim_id)
                    ->withFail(__('general.Create failed') . ' ' . $e->getMessage());
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $result->id,
                'message' => __('general.Created successfully'),
            ], Response::HTTP_OK);
        } else {
            return back()
                ->withSuccess(__('general.Created successfully'));
        }
    }

    public function edit(int $claim_id, int $note_id)
    {
        try {
            $result = $this->noteService->get($note_id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.notes.edit', ['data' => $result, 'claim_id' => $claim_id]);
    }

    public function update(NoteSaveRequest $request, int $claim_id, int $note_id)
    {
        $data = $request->validated();

        try {
            $this->noteService->updateNote($data, $note_id);

            return redirect()
                ->route('admin.claims.notes.allByClaimId', $claim_id)
                ->withSuccess(__('general.Updated successfully'));
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Update failed') . ' ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(int $claim_id, int $note_id)
    {
        try {
            $this->noteService->destroy($note_id);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $note_id,
                    'message' => __('general.Deleted successfully'),
                ], Response::HTTP_OK);
            } else {
                return redirect()
                    ->route('admin.claims.notes.allByClaimId', $claim_id)
                    ->withSuccess(__('general.Deleted successfully'));
            }
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $note_id,
                    'message' => $e->getMessage(),
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            } else {
                return redirect()
                    ->route('admin.claims.notes.allByClaimId', $claim_id)
                    ->withFail(__('general.Delete failed') . ' ' . $e->getMessage());
            }
        }
    }
}
