<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.roles', compact('roles','permissions','notifications'));
    }

    public function create()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        $permissions = Permission::all();
        return view('admin.create_role', compact('permissions','notifications'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:roles',
        'permissions' => 'required|array',
    ]);
    $role = Role::create([
        'name' => $request->input('name'),
    ]);
    $permissions = $request->input('permissions', []);
    $role->permissions()->attach($permissions);
    return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
}
    public function edit(Role $role)
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        $permissions = Permission::all();
        return view('admin.edit_role', compact('role', 'permissions','notifications'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        $permissions = $request->input('permissions', []);
        $role->permissions()->sync($permissions);
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}

