<?php

namespace App\Services;

use App\Repositories\NoteRepositoryInterface;
use Exception;

class NoteService
{
    private $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function get($id)
    {
        return $this->noteRepository->get($id);
    }

    public function notesByClaimId(int $claim_id)
    {
        return $this->noteRepository->notesByClaimId($claim_id);
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

    /**
     * @param array $all
     * @return mixed
     */
}
