<?php

namespace App\Services;

use App\Helpers\SimpleTable;
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
        $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
        $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;
        $pagination = request('pagination') ?? $this->noteRepository->getPagination();

        //sort data
        $query = $this->noteRepository->getData($claim_id)->orderBy($sortKey,$sortDirection);

        if ($pagination) {
            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;

            $paginate = $query->paginate($rows);
//            $data['data'] = $this->noteRepository->getRelatedData($paginate);
            $data['data'] = $paginate->items();
            $pag = $paginate->toArray();
            unset($pag['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
            $data['pagination'] = $pag;
        } else {
            $data = $query->get();
        }

        return $data;
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
