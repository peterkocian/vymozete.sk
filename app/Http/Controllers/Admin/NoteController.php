<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteSaveRequest;
use App\Models\Note;
use App\Services\ClaimService;
use App\Services\NoteService;
use Illuminate\Validation\ValidationException;

class NoteController extends Controller
{
    protected $noteService;
    protected $claimService;

    public function __construct(NoteService $noteService, ClaimService $claimService)
    {
        $this->noteService = $noteService;
        $this->claimService = $claimService;
    }

    public function index()
    {
        // return Note::all();
    }

    public function getByClaimId(int $claim_id)
    {
        $result = $this->noteService->notesByClaimId($claim_id);

        $claim = $this->claimService->get($claim_id);

        if (request()->ajax()) {
            return response()->json($result);
        }
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $result,
            'tab' => 'notes'
        ]);
    }

    public function store(NoteSaveRequest $request, int $claim_id)
    {
        if ($request->ajax())
        {
            $data = $request->except('_token', '_method');

            try {
                $result = $this->noteService->saveNote($data, $claim_id);
            } catch (\Exception $e) {
                report($e);

                return response()->json([
                    'success' => false,
                    'message' => __('general.Create failed') . PHP_EOL . $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'success' => true,
                'id' => $result->id,
                'message' => __('general.Created successfully'),
            ], 200);
        }

        return back()
            ->withFail('povoleny iba ajax request');
    }

    public function edit(int $id)
    {
        try {
            $result = $this->noteService->get($id);
        } catch (\Exception $e) {
            report($e);

            //todo dopisat error message - vymysliet standard
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.notes.edit', ['note' => $result]);
    }

    public function update(int $id)
    {
        $data = request()->except('_token', '_method');

        try {
            $result = $this->noteService->updateNote($data, $id);
        } catch (ValidationException $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'))
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed').PHP_EOL.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.claims.notes.byClaimId', 1)
            ->withSuccess(__('general.Created successfully'));
    }

    public function destroy(int $id)
    {
        Note::findOrFail($id)->delete();
    }
}
