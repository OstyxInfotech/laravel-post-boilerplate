<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Event;
use App\Events\Auth\RolePermissionsChanged;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index')->withRoles(Role::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role=$request->validate([
            'name' => 'required|max:128|unique:roles,name|bail'
        ]);
        $role['slug'] = str_slug($role['name']);

        Role::create($role);

        return redirect('/roles')->withStatus('Successfully created role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $models=Permission::all()->unique('model')->pluck('model');
        $permissions=Permission::all();
        $role_permissions=$role->permissions;

        return view('roles.show')->with(compact('role', 'models', 'permissions', 'role_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //$updates=array_keys($request->except('_token', '_method'));
        $updates=$request->has('permissions') ? $request->only('permissions')['permissions'] : [];
        $role->permissions()->sync($updates);
        Event(new RolePermissionsChanged($role));
        return redirect('/roles')->withSuccess('Successfully updated role permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
