<?php

namespace App\Repositories\Eloquent;

use App\Models\Claim;
use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    /**
     * FileRepository constructor.
     *
     * @param File $model
     */
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function getData(int $claim_id = null, array $searchParams = []): Builder // pretazena metoda z BaseRepository
    {
        return Claim::find($claim_id)->files()->getQuery();
    }

    public function getRelatedData($data): Collection
    {
        return $data->append([
            'showToCustomerLabel',
            'fileTypeName',
        ]);
    }
}
