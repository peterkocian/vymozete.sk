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
            return $result = $this->noteRepository->save($data, $claim_id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateNote($data, $id)
    {
        try {
            return $this->noteRepository->update($data, $id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            return $this->noteRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
