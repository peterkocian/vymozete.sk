<?php

namespace App\Services;

use App\Repositories\PermissionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    private $permissionRepository;
    private $simpleTableService;

    public function __construct(PermissionRepositoryInterface $permissionRepository, SimpleTableService $simpleTableService)
    {
        $this->permissionRepository = $permissionRepository;
        $this->simpleTableService = $simpleTableService;
    }

    public function all()
    {
        return $this->simpleTableService->processSimpleTableData($this->permissionRepository, null, false);
    }

    public function get($id)
    {
        return $this->permissionRepository->get($id);
    }

    /**
     * Store a new user into DB.
     *
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function savePermission($data)
    {
        try {
            return $this->permissionRepository->save($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update permission entry in DB.
     *
     * @param $data
     * @param null $id
     * @return mixed
     * @throws Exception
     */
    public function updatePermission($data, $id)
    {
        try {
            return $this->permissionRepository->update($data, $id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->permissionRepository->get($id);
            return $this->permissionRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
