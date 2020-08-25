<?php

namespace App\Services;

use App\Repositories\NoteRepositoryInterface;
use Exception;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NoteService
{
    private $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
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
}
