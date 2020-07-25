<?php

namespace App\Services;

use App\Repositories\PermissionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PermissionService
{
    private $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function all()
    {
        return $this->permissionRepository->all();
    }

    public function getProjection()
    {
        return $this->permissionRepository->getProjection();
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
        } catch (Exception $e) {
            DB::rollBack();
//            Log::info($e->getMessage());
            throw new Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
        }

        DB::commit();

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
