<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface NoteRepositoryInterface
{
    /**
     * @param array $attributes
     * @param $claim_id
     * @return Model
     */
    public function save(array $attributes, $claim_id): Model;

    public function getTableDataa(Model $model, int $id);
}
