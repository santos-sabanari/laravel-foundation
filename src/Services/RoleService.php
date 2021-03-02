<?php

namespace SantosSabanari\LaravelFoundation\Services;

use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;
use SantosSabanari\LaravelFoundation\Services\BaseService;
use SantosSabanari\LaravelFoundation\Events\RoleCreated;
use SantosSabanari\LaravelFoundation\Events\RoleDeleted;
use SantosSabanari\LaravelFoundation\Events\RoleUpdated;

/**
 * Class RoleService.
 */
class RoleService extends BaseService
{
    /**
     * RoleService constructor.
     *
     * @param  Role  $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @param  array  $data
     *
     * @return Role
     * @throws Exception
     * @throws \Throwable
     */
    public function store(array $data = []): Role
    {
        DB::beginTransaction();

        try {
            $role = $this->model::create(['type' => $data['type'], 'name' => $data['name']]);
            $role->syncPermissions($data['permissions'] ?? []);
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception(__('There was a problem creating the role.'));
        }

        event(new RoleCreated($role));

        DB::commit();

        return $role;
    }

    /**
     * @param  Role  $role
     * @param  array  $data
     *
     * @return Role
     * @throws Exception
     * @throws \Throwable
     */
    public function update(Role $role, array $data = []): Role
    {
        DB::beginTransaction();

        try {
            $role->update(['type' => $data['type'], 'name' => $data['name']]);
            $role->syncPermissions($data['permissions'] ?? []);
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception(__('There was a problem updating the role.'));
        }

        event(new RoleUpdated($role));

        DB::commit();

        return $role;
    }

    /**
     * @param  Role  $role
     *
     * @return bool
     * @throws Exception
     */
    public function destroy(Role $role): bool
    {
        if ($role->users()->count()) {
            throw new Exception(__('You can not delete a role with associated users.'));
        }

        if ($this->deleteById($role->id)) {
            event(new RoleDeleted($role));

            return true;
        }

        throw new Exception(__('There was a problem deleting the role.'));
    }
}
