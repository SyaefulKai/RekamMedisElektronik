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
        $this->authorize('viewAny', Role::class);
        return Inertia::render('authorization/roles/Index', [
            'roles' => Role::with('permissions')->get(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', Role::class);
        return Inertia::render('authorization/roles/Create');
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        $role->load('permissions');
        return Inertia::render('authorization/roles/Edit', [
            'role' => $role,
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        $this->authorize('create', Role::class);
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
        $this->authorize('update', $role);
        $role->syncPermissions($data['permissions']);
        return redirect()->back();
    }

    public function delete(Role $role)
    {
        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->back();
    }
}
