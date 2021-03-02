<?php

namespace SantosSabanari\LaravelFoundation\Http\Controllers;

use SantosSabanari\LaravelFoundation\Http\Requests\DeleteRoleRequest;
use SantosSabanari\LaravelFoundation\Http\Requests\EditRoleRequest;
use SantosSabanari\LaravelFoundation\Http\Requests\StoreRoleRequest;
use SantosSabanari\LaravelFoundation\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use SantosSabanari\LaravelFoundation\Services\PermissionService;
use SantosSabanari\LaravelFoundation\Services\RoleService;
use App\Http\Controllers\Controller;

/**
 * Class RoleController.
 */
class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    protected $roleService;

    /**
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * RoleController constructor.
     *
     * @param  RoleService  $roleService
     * @param  PermissionService  $permissionService
     */
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('laravel-foundation::system.role.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('laravel-foundation::system.role.create')
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions());
    }

    /**
     * @param  StoreRoleRequest  $request
     *
     * @return mixed
     * @throws Exception
     * @throws \Throwable
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roleService->store($request->validated());

        return redirect()->route('backend.system.role.index')->withFlashSuccess(__('The role was successfully created.'));
    }

    /**
     * @param  EditRoleRequest  $request
     * @param  Role  $role
     *
     * @return mixed
     */
    public function edit(EditRoleRequest $request, Role $role)
    {
        return view('laravel-foundation::system.role.edit')
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions())
            ->withRole($role)
            ->withUsedPermissions($role->permissions->modelKeys());
    }

    /**
     * @param  UpdateRoleRequest  $request
     * @param  Role  $role
     *
     * @return mixed
     * @throws Exception
     * @throws \Throwable
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roleService->update($role, $request->validated());

        return redirect()->route('backend.system.role.index')->withFlashSuccess(__('The role was successfully updated.'));
    }

    /**
     * @param  DeleteRoleRequest  $request
     * @param  Role  $role
     *
     * @return mixed
     * @throws Exception
     */
    public function destroy(DeleteRoleRequest $request, Role $role)
    {
        $this->roleService->destroy($role);

        return redirect()->route('backend.system.role.index')->withFlashSuccess(__('The role was successfully deleted.'));
    }
}
