<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Interface EloquentRepositoryInterface
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Get's an entity by it's ID.
     *
     * @param int $id
     * @return Model
     */
    public function get($id): ?Model;

    /**
     * Get's all entities.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Deletes an entity by it's ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id): boolean;

    /**
     * Updates an entity by it's ID.
     *
     * @param int $id
     * @param array $attributes
     * @return Model
     */
    public function update(array $attributes, $id): Model;
}
