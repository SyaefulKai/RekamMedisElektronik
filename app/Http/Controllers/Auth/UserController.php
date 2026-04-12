<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('auth/Index', [
            'users' => User::paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('auth/Create', [
            'roles' => Role::whereHas('permissions')->get()
        ]);
    }

    public function store(CreateUserRequest $request)
    {
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
}
