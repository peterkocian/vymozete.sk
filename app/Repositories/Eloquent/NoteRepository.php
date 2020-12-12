<?php

namespace App\Repositories\Eloquent;

use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// custom actions for note repository
class NoteRepository extends BaseRepository implements NoteRepositoryInterface
{
    private $claimRepository;

    /**
     * NoteRepository constructor.
     *
     * @param Note $model
     * @param ClaimRepository $claimRepository
     */
    public function __construct(
        Note $model,
        ClaimRepository $claimRepository
    )
    {
        parent::__construct($model);
        $this->claimRepository = $claimRepository;
    }

    /**
     * Create an entity.
     *
     * @param array $attributes
     * @param int $claim_id
     * @return Model
     */
    public function save(array $attributes, int $claim_id): Model
    {
        $claim = $this->claimRepository->get($claim_id);
        $attributes['claim_id'] = $claim->id;
        $attributes['user_id'] = Auth::id();

        return $this->model->create($attributes);
    }

    public function getData(int $claim_id = null, array $searchParams = []): Builder // pretazena metoda z BaseRepository
    {
        return $this->claimRepository->get($claim_id)->notes()->getQuery();
    }
}
