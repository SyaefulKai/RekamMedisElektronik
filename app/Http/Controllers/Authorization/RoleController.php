<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\UpdatePermissionRequest;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return Inertia::render('authorization/roles/Index', [
            'roles' => Role::with('permissions')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('authorization/roles/Create');
    }

    public function edit(Role $role)
    {
        return Inertia::render('authorization/roles/Edit', [
            'role' => $role->with('permissions')->first()
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create([
            'name' => $data['name'],
        ]);
        $role->syncPermissions($data['permissions'] ?? []);
        return redirect()->to(route('role.index'));
    }

    public function update(UpdatePermissionRequest $request)
    {
        $data = collect($request->validated());
        $role = Role::findById($data['role']);
        $role->syncPermissions($data['permissions']);
        return redirect()->back();
    }
}
