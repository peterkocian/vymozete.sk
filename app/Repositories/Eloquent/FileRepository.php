<?php

namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    private $claimRepository;

    /**
     * FileRepository constructor.
     *
     * @param File $model
     * @param ClaimRepository $claimRepository
     */
    public function __construct(
        File $model,
        ClaimRepository $claimRepository
    )
    {
        parent::__construct($model);
        $this->claimRepository = $claimRepository;
    }

    public function getData(int $claim_id = null, array $searchParams = []): Builder // pretazena metoda z BaseRepository
    {
        return $this->claimRepository->get($claim_id)->files()->getQuery();
    }

    public function getRelatedData($data): Collection
    {
        return $data->append([
            'showToCustomerLabel',
            'fileTypeName',
        ]);
    }

    public function getPagination(string $fromPage = null)
    {
        if ($fromPage === 'overview') {
            return $this->model::OVERVIEW_VIEW_PAGINATION;
        }
        return $this->model::INDEX_VIEW_PAGINATION;
    }
}
