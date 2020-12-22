<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
    private $userRepository;
    private $simpleTableService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        SimpleTableService $simpleTableService
    )
    {
        $this->userRepository = $userRepository;
        $this->simpleTableService = $simpleTableService;
    }

    public function get($id)
    {
        return $this->userRepository->get($id);
    }

    public function all()
    {
        return $this->simpleTableService->processSimpleTableData($this->userRepository, null, false);
    }

    /**
     * Store a new user into DB.
     *
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function saveUser($data)
    {
        $data['password'] = $data['password'] ? bcrypt($data['password']) : null;

        DB::beginTransaction();
        try {
            $result = $this->userRepository->save($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Update user entry in DB.
     *
     * @param $data
     * @param null $id
     * @return mixed
     * @throws Exception
     */
    public function updateUser($data, $id = null)
    {
        $data['roles'] = $data['roles'] ?? [];
        $data['permissions'] = $data['permissions'] ?? [];

        DB::beginTransaction();
        try {
            $result = $this->userRepository->update($data, $id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function destroy(int $id)
    {
        try {
            $this->userRepository->get($id);
            return  $this->userRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update user profile.
     *
     * @param $data
     * @param null $id user id
     * @return mixed
     * @throws Exception
     */
    public function updateUserProfile(array $data, $id = null)
    {
        DB::beginTransaction();
        try {
            $result = $this->userRepository->update($data, $id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Update user ban state in DB.
     *
     * @param null $id
     * @return mixed
     * @throws Exception
     */
    public function updateUserBan($id, $action)
    {
        $user = $this->get($id);

        if ($action === 'ban' ) {
            if ($user->banned) {
                throw new \Exception(__('general.Already banned'));
            } else {
                $user['banned'] = 1; //true
            }
        } else {
            if ($user->banned) {
                $user['banned'] = 0; //false
            } else {
                throw new \Exception(__('general.Already unbanned'));
            }
        }

        try {
            return $this->userRepository->updateBanned($user);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
