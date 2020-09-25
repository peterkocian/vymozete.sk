<?php

namespace App\Services;

use App\Repositories\PermissionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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

    public function getProjection()
    {
        return $this->permissionRepository->getProjection();
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
     * @throws ValidationException
     */
    public function savePermission($data)
    {
        $validator = $this->validator($data);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $result = $this->permissionRepository->save($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Update permission entry in DB.
     *
     * @param $data
     * @param null $id
     * @return mixed
     * @throws ValidationException
     * @throws Exception
     */
    public function updatePermission($data, $id)
    {
        $validator = $this->validator($data);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $result = $this->permissionRepository->update($data, $id);
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
            $this->permissionRepository->get($id);
            $result = $this->permissionRepository->delete($id);
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
//            'slug' => 'required|max:191',    nastavuje mutator
        ]);
    }
}
