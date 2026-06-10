<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Models\User;
use App\Queries\UserQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserQueryBuilder $query)
    {
        $this->authorize('viewAny', User::class);
        return Inertia::render('auth/Index', [
            'users' => $query->paginate(10)
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
        Inertia::flash('userCreated', "Data $user->name berhasil dibuat.");
        return to_route('user.index');
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
        Inertia::flash('userUpdated', "Data $user->name berhasil diperbarui.");
        return redirect()->to(route('user.index'));
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        Inertia::flash('userDeleted', 'Data pengguna berhasil dihapus.');
        return redirect()->back();
    }
}
