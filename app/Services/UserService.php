<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use App\Rules\EmailMustHaveTLD;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getProjection()
    {
        return $this->userRepository->getProjection();
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    /**
     * Store a new user into DB.
     *
     * @param $data
     * @param null $id
     * @return mixed
     * @throws ValidationException
     * @throws Exception
     */
    public function saveUser($data)
    {
        $validator = $this->validator($data);
        $data['password'] = $data['password'] ? bcrypt($data['password']) : null;

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $result = $this->userRepository->save($data);
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
        }

        DB::commit();

        return $result;
    }

    /**
     * Update user entry in DB.
     *
     * @param $data
     * @param null $id
     * @return mixed
     * @throws ValidationException
     * @throws Exception
     */
    public function updateUser($data, $id = null)
    {
        $validator = $this->validator($data, $id);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $result = $this->userRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
        }

        DB::commit();

        return $result;
    }

    public function updateUserProfile($data, $id = null)
    {
        DB::beginTransaction();

        try {
            $result = $this->userRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
        }

        DB::commit();

        return $result;
    }

    /**
     * @param array $all
     * @param $id
     * @return mixed
     */
    private function validator(array $all, $id = null)
    {
        return \Validator::make($all, [
            'name'      => 'required|max:191',
            'surname'   => 'required|max:191',
            'password'  => 'nullable|min:6|confirmed',
            'email'     => ['nullable','email',new EmailMustHaveTLD,'unique:users,email,'.$id],
            'roles'     => 'required_without:permissions',
            'permissions' => 'required_without:roles'
        ]);
    }
}
