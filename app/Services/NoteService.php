<?php

namespace App\Services;

use App\Repositories\NoteRepositoryInterface;
use Exception;
use Illuminate\Validation\ValidationException;

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
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
        }

        return $result;
    }

    public function updateNote($data, $id)
    {
        $validator = $this->validator($data);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        try {
            $result = $this->noteRepository->update($data, $id);
        } catch (Exception $e) {
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
        }

        return $result;
    }

    /**
     * @param array $all
     * @return mixed
     */
    private function validator(array $all)
    {
        return \Validator::make($all, [
            'title' => 'required|max:191',
            'description' => 'required',
        ]);
    }
}
