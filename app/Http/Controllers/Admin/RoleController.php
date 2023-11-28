<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('Site.Roles.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('Site.Roles.Crud.add-role', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'role' => 'required',
            'permissions' => 'required'
        ]);
        $role = Role::create(['name' => $request->post('role')]);
        $role->syncPermissions($request->post('permissions'));
        session()->flash('success', __('Created Role With Permissions'));
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('Site.Roles.Crud.show-role', compact('permissions', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('Site.Roles.Crud.edit-role', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);
        $role->update(['name' => $request->post('role')]);
        $role->syncPermissions($request->post('permissions'));
        session()->flash('success', __('Updated Role With Permissions'));
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('success', __('Deleted Role With Permissions'));
        return redirect()->route('role.index');
    }
}
