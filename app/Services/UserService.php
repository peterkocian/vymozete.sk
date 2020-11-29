<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use App\Rules\EmailMustHaveTLD;
use App\Rules\StrongPassword;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserService
{
    private $userRepository;
    private $simpleTableService;

    public function __construct(UserRepositoryInterface $userRepository, SimpleTableService $simpleTableService)
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
     * @throws ValidationException
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
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
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
     * @throws ValidationException
     * @throws Exception
     */
    public function updateUser($data, $id = null)
    {
        dd($data, $id);
        $validator = $this->validator($data, $id);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $result = $this->userRepository->update($data, $id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function destroy(int $id)
    {
        try {
            $this->userRepository->get($id);
            $result = $this->userRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $result;
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
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Update user ban state in DB.
     *
     * @param $data
     * @param null $id
     * @return mixed
     * @throws ValidationException
     * @throws Exception
     */
    public function updateUserBan($data, $id = null)
    {
        $validator = $this->banValidator($data, $id);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $result = $this->userRepository->update($data, $id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

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
            'password'  => ['nullable','confirmed',new StrongPassword()],
            'email'     => ['required','email',new EmailMustHaveTLD,'unique:users,email,'.$id],
            'roles'     => 'required_without:permissions',
            'permissions' => 'required_without:roles',
            'banned'    => 'nullable|boolean'
        ]);
    }

    /**
     * @param array $all
     * @return mixed
     */
    private function banValidator(array $all)
    {
        return \Validator::make($all, [
            'banned'    => 'nullable|boolean'
        ]);
    }
}
