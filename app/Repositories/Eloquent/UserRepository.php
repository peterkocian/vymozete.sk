<?php

namespace App\Repositories\Eloquent;

use App\Models\Front\Language;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
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

    public function update(array $attributes, $id): Model
    {
        if ($id) {
            try {
                $user = $this->model->findOrFail($id);
            } catch (\Exception $e) {
                report($e);
                throw new \Exception('Uzivatela sa nepodarilo najst z neznamych dovod.'. $e->getMessage());
            }
        }

        $attributes['password'] = $attributes['password'] ? bcrypt($attributes['password']) : $user->password;

        if ($user) {
            $user->update($attributes);
            $user->roles()->sync($attributes['roles'] ?? []);
            $user->permissions()->sync($attributes['permissions'] ?? []);

            return $user;
        }
    }
}
