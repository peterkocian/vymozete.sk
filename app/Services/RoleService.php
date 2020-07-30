<?php

namespace App\Services;

use App\Repositories\RoleRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RoleService
{
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function all()
    {
        return $this->roleRepository->all();
    }

    public function getProjection()
    {
        return $this->roleRepository->getProjection();
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
    public function saveRole($data)
    {
        $validator = $this->validator($data);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $result = $this->roleRepository->save($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
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
    public function updateRole($data, $id)
    {
        $validator = $this->validator($data);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $result = $this->roleRepository->update($data, $id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
        }

        return $result;
    }

    /**
     * @param array $all
     * @return mixed
     */
    private function validator(array $all)
    {
        return \Validator::make($all, [
            'name' => 'required|max:191',
//            'slug' => 'required|max:191',    nastavuje mutator,
            'permissions' => 'required'
        ]);
    }
}
