<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Events\ActiveCode;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\ServicesLayer\Authentication\Register;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('Site.Users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('Site.Users.Crud.add-user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = (new Register)->register($request);
        event(new ActiveCode($user));
        $user->assignRole($request->post('role'));
        session()->flash('success', __('Created User'));
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('Site.Users.Crud.edit-user', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $id = $user->id;
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'required|min:8|max:20|confirmed',
            'role' => 'required|array',
        ]);
        $user->update($request->all());
        $user->syncRoles($request->post('role'));
        session()->flash('success', __('Updated User'));
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', __('Deleted User'));
        return redirect()->route('user.index');
    }
}
