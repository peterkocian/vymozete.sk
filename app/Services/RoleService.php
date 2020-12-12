<?php

namespace App\Services;

use App\Repositories\RoleRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

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
     * @throws Exception
     */
    public function saveRole($data)
    {
        DB::beginTransaction();
        try {
            $result = $this->roleRepository->save($data);
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
    public function updateRole($data, $id)
    {
        DB::beginTransaction();
        try {
            $result = $this->roleRepository->update($data, $id);
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
            $this->roleRepository->get($id);
            $result = $this->roleRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $result;
    }
}
