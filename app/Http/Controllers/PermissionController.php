<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        $permissions = Permission::all();
        return view('admin.permissions', compact('permissions','notifications'));
    }

    public function create()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('admin.create_permission',compact('notifications'));
    }
    
    public function store(Request $request)
    {
        Permission::create($request->all());
        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('admin.edit_permission', compact('permission',compact('notifications')));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
