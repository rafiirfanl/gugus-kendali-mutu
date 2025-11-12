<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:user')->only(['index']);
        $this->middleware('permission:create:user')->only(['store']);
        $this->middleware('permission:edit:user')->only(['update']);
        $this->middleware('permission:delete:user')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('admin.user.index', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $userData = $request->validated();

        if ($request->email_verified) {
            $userData['email_verified_at'] = now();
        } else {
            $userData['email_verified_at'] = null;
        }

        if (!empty($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        }

        $role = $userData['role'];
        unset($userData['role']);

        $user = User::create($userData);
        $user->assignRole($role);

        return back()->with('success', 'Successfully Create New User!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = User::findOrFail($user->id);
        $userData = $request->validated();

        if ($request->email_verified == '1') {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }

        if (!empty($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        } else {
            unset($userData['password']);
        }

        $role = $userData['role'];
        unset($userData['role']);

        $user->update($userData);

        $user->syncRoles($role);

        return back()->with('success', 'Successfully Edit User!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user)
    {
        User::findOrFail($user)->forceDelete();
        return back()->with('success', 'Successfully Delete User!');
    }
}
