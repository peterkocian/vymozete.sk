<?php

namespace App\Services;

use App\Repositories\RoleRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RoleService
{
    private $roleRepository;
    private $simpleTableService;

    public function __construct(RoleRepositoryInterface $roleRepository, SimpleTableService $simpleTableService)
    {
        $this->roleRepository = $roleRepository;
        $this->simpleTableService = $simpleTableService;
    }

    public function all()
    {
        return $this->simpleTableService->processSimpleTableData($this->roleRepository, null, false);
    }

    public function get($id)
    {
        return $this->roleRepository->get($id);
    }

    /**
     * Store a new user into DB.
     *
     * @param $data
     * @return mixed
     * @throws ValidationException
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
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function destroy(int $id)
    {
        try {
            $this->roleRepository->get($id);
            $result = $this->roleRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
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
