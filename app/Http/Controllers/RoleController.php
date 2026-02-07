<?php

namespace App\Http\Controllers;

use App\Traits\RolesAuthorizable;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\PermissionGroup;
use App\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use RolesAuthorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['roles'] = Role::all();

        return view('role.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['action'] = "/role";
        return view('role.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        Role::create($request->all());

        return redirect('/role')->with('success', 'New role has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->data['action'] = "/role/showaction/" . $role->id;
        $this->data['permission_groups'] = PermissionGroup::whereNull('permission_group_id')->get();
        $this->data['permissions'] = Permission::whereNull('permission_group_id')->get();

        $this->data['role'] = $role;

        return view('role.permission', $this->data);
    }

    public function showaction(Request $request, Role $role)
    {
        $permission_array = explode(',', $request['permission']);

        foreach ($role->permissions as $permission) {
            if (!in_array($permission['id'], $permission_array)) {
                $permission = Permission::find($permission['id']);
                $role->revokePermissionTo($permission);
            }
        }

        foreach ($permission_array as $permission_id) {
            $permission = Permission::find($permission_id);
            $role->givePermissionTo($permission['name']);
        }

        return redirect('/role')->with('success', 'Permission has been updated!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->data['role_data'] = $role;
        $this->data['action'] = "/role/" . $role->id;
        return view('role.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        Role::find($role->id)
            ->update($request->all());

        return redirect('/role')->with('success', 'Role has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Role::destroy($role->id);
        return redirect('/role')->with('success', 'Role has been deleted!');
    }
}
