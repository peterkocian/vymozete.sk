<?php

namespace App\Services;

use App\Repositories\NoteRepositoryInterface;
use Exception;

class NoteService
{
    private $noteRepository;
    private $simpleTableService;

    public function __construct(
        NoteRepositoryInterface $noteRepository,
        SimpleTableService $simpleTableService
    )
    {
        $this->noteRepository = $noteRepository;
        $this->simpleTableService = $simpleTableService;
    }

    public function get($id)
    {
        return $this->noteRepository->get($id);
    }

    public function notesByClaimId(int $claim_id)
    {
        return $this->simpleTableService->processSimpleTableData($this->noteRepository, $claim_id, false);
    }

    public function saveNote(array $data, int $claim_id)
    {
        try {
            $result = $this->noteRepository->save($data, $claim_id);
        } catch (Exception $e) {
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function updateNote($data, $id)
    {
        try {
            $result = $this->noteRepository->update($data, $id);
        } catch (Exception $e) {
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function destroy(int $id)
    {
        try {
            $result = $this->noteRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $result;
    }
}
