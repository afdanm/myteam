<?php

namespace App\Http\Controllers;

use App\Traits\PermissionGroupsAuthorizable;
use App\Models\PermissionGroup;
use App\Http\Requests\StorePermissionGroupRequest;
use App\Http\Requests\UpdatePermissionGroupRequest;

class PermissionGroupController extends Controller
{
    use PermissionGroupsAuthorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['permissiongroups'] = PermissionGroup::all();

        return view('permissiongroup.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['permissiongroups'] = PermissionGroup::all();

        $this->data['action'] = "/permissiongroup";
        return view('permissiongroup.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePermissionGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionGroupRequest $request)
    {
        PermissionGroup::create($request->all());

        return redirect('/permissiongroup')->with('success', 'New permission group has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermissionGroup  $permissiongroup
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionGroup $permissiongroup)
    {
        $this->data['permissiongroups'] = PermissionGroup::all();

        $this->data['permissiongroup_data'] = $permissiongroup;
        $this->data['action'] = "/permissiongroup/".$permissiongroup->id;
        return view('permissiongroup.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionGroupRequest  $request
     * @param  \App\Models\PermissionGroup  $permissiongroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionGroupRequest $request, PermissionGroup $permissiongroup)
    {
        PermissionGroup::find($permissiongroup->id)
            ->update($request->all());

        return redirect('/permissiongroup')->with('success', 'Permission Group has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermissionGroup  $permissiongroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermissionGroup $permissiongroup)
    {
        PermissionGroup::destroy($permissiongroup->id);
        return redirect('/permissiongroup')->with('success', 'Permission Group has been deleted!');
    }
}
