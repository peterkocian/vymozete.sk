<?php

namespace App\Repositories\Eloquent;

use App\Helpers\SimpleTable;
use App\Models\Claim;
use App\Repositories\ClaimRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ClaimRepository extends BaseRepository implements ClaimRepositoryInterface
{
    /**
     * ClaimRepository constructor.
     *
     * @param Claim $model
     */
    public function __construct(Claim $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->with(['creditor.entity.fullname', 'debtor'])->get();
    }

    // todo takato funkcia ma byt v Repository, alebo v Service? podla mna v Repository, lebo vysledok funkcie je zavisly od Eloquentu.
    public function index(): array
    {
//        $claims = $this->model->all();

        $claims = $this->getTableData($this->model);

//        dd($claims);

//        foreach ($claims as $claim) {
//            $claim['amountWithCurrency'] = $claim->amountWithCurrency;
//            $claim['debtorPlain']   = $claim->debtor->entity->fullname;
//            $claim['creditorPlain'] = $claim->creditor->entity->fullname;
//            $claim['statusPlain']   = $claim->claimStatus->name;
//            $claim['typePlain']     = $claim->claimType->translation(\Illuminate\Support\Facades\Auth::user()->language_id)->firstOrFail()->name;
//        }

        return $claims;
    }

    public function allByUser(int $id): Collection
    {
        return $this->model->all()->where('user_id', $id);
    }

    public function files(int $id)
    {
        return $this->model->files();
    }

    /**
     * Returns all entities formated for index view for SimpleTableComponent with sorting, searching, pagination.
     *
     * @param Model $model
     * @return array
     */
    public function getTableData(Model $model)
    {
//        $claims = Claim::with(['claimType'])
//            ->join('claim_type', 'claim_type_id', '=', 'claim_type.id')
//            ->orderBy('claim_type.key', 'desc')
//            ->get();
//        dd($claims->toArray());

        $pagination = request('pagination') ?? $model::INDEX_VIEW_PAGINATION;

        if ($model) {
            $rows = request('rows') ? intval(request('rows')) : SimpleTable::NUMBER_OF_ROWS;
            $sortKey = request('sortKey') ? request('sortKey') : SimpleTable::SORT_KEY;
            $sortDirection = request('sortDirection') ? request('sortDirection') : SimpleTable::SORT_DIRECTION;

            $data = $model::orderBy($sortKey, $sortDirection);

            if ($pagination) {
                $data = $this->getRelations($model->get());
                if ($sortDirection === 'asc') {
                    $sorted = $data->sortBy($sortKey);
//                    dd($data->sortBy($sortKey));
                } else {
                    $sorted = $data->sortByDesc($sortKey);
//                    dd($data->sortByDesc($sortKey));
                }
                dd($sorted);
                $paginate = $sorted->paginate($rows);

                $paginate = $this->getRelations($paginate);
                $arr = $paginate->toArray();
                $result['data'] = $arr['data'];
                unset($arr['data']);  // z povodneho objektu paginate ktory vracia Laravel mazem data, aby mi v result['pagination'] posielalo na FE iba info o strankovani
                $result['pagination'] = $arr;
            } else {
//                $data = $this->getRelations($model->get());
//                if ($sortDirection === 'asc') {
//                    $sorted = $data->sortBy($sortKey);
////                    dd($data->sortBy($sortKey));
//                } else {
//                    $sorted = $data->sortByDesc($sortKey);
////                    dd($data->sortByDesc($sortKey));
//                }
////                dd($sorted->toArray());
//                $result = $sorted->toArray();
                $data = $this->getRelations($data->get());
                $result = $data->toArray();
            }

            return $result;
        }
    }

    public function getRelations($data)
    {
        foreach ($data as $claim) {
            $claim['amountWithCurrency'] = $claim->amountWithCurrency;
            $claim['debtorPlain']   = $claim->debtor->entity->fullname;
            $claim['creditorPlain'] = $claim->creditor->entity->fullname;
            $claim['statusPlain']   = $claim->claimStatus->name;
            $claim['typePlain']     = $claim->claimType->translation(\Illuminate\Support\Facades\Auth::user()->language_id)->firstOrFail()->name;
        }

        return $data;
    }
}
