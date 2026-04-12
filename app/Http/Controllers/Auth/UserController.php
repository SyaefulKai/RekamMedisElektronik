<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return Inertia::render('auth/Index', [
            'users' => User::paginate(10)
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return Inertia::render('auth/Create', [
            'roles' => Role::whereHas('permissions')->get()
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $this->authorize('create', User::class);
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $role = Role::where('id', $data['role'])->firstOrFail();
        $user->assignRole($role);
        return redirect()->to(route('user.index'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $user->load('roles:id,name');
        return Inertia::render('auth/Edit', [
            'user' => $user,
            'roles' => Role::whereHas('permissions')->get()
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->validated();
        $user->update($data);
        $role = Role::where('id', $data['role'])->firstOrFail();
        $user->syncRoles($role);
        return redirect()->to(route('user.index'));
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->back();
    }
}
