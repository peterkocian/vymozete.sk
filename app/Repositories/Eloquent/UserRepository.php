<?php

namespace App\Repositories\Eloquent;

use App\Models\Language;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;

// custom actions for user repository
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Create an entity.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function save(array $attributes): Model
    {
        $language = Language::where('default', 1)->firstOrFail();

        $this->model->fill($attributes);
        $this->model->language()->associate($language->id);
        if ($this->model->save()) {
            $this->model->roles()->sync($attributes['roles'] ?? []);
            $this->model->permissions()->sync($attributes['permissions'] ?? []);
        }

        return $this->model->fresh();
    }

    public function update(array $attributes, int $id): Model
    {
        try {
            $user = $this->get($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        $attributes['password'] = isset($attributes['password']) ? bcrypt($attributes['password']) : $user->password;

        $user->update($attributes);
        if (isset($attributes['roles'])) {
            $user->roles()->sync($attributes['roles']);
        }
        if (isset($attributes['permissions'])) {
            $user->permissions()->sync($attributes['permissions']);
        }

        return $user;
    }

    public function updateBanned(Model $user): bool
    {
        return $user->update($user->getAttributes());
    }
}
