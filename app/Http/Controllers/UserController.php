<?php

namespace App\Http\Controllers;

use App\Traits\UsersAuthorizable;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\DataTables\UserDataTable;

class UserController extends Controller
{
    use UsersAuthorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,UserDataTable $dataTable)
    {
        if($request->ajax()){
            return $dataTable->ajax();
        }
        return $dataTable->render('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['action'] = '/user';
        return view('user.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['user_data'] = User::where('id',$id)->first();
        $this->data['action'] = "/user/".$id;
        return view('user.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function role(User $user)
    {
        $this->data['roles'] = Role::all();
        $this->data['permissions'] = $user->getAllPermissions();
        $this->data['user'] = $user;
        //return $this->data['permissions'];
        $this->data['action'] = "/user/roleaction/" . $user->id;
        return view('user.role', $this->data);
    }

    public function roleaction(Request $request, User $user)
    {
        $user->syncRoles($request['roles']);

        return redirect('/user')->with('success', 'Roles ' . $user->name . ' has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('User Banned'), 403);
    }
}
