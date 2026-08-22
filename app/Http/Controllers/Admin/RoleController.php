<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Role List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $roles = Role::with('permissions')
            ->where('guard_name', 'web')
            ->where('name', '!=', 'Admin')
            ->orderBy('id', 'desc')
            ->get();

        return view('Admin.roles.index', compact('roles'));
    }


    /*
    |--------------------------------------------------------------------------
    | Create Role Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view(
            'Admin.roles.create',
            compact('permissions')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Role
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        if ($request->filled('permissions')) {
            $role->syncPermissions(
                $request->permissions
            );
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Role Page
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $role = Role::where('guard_name', 'web')
            ->findOrFail($id);

        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        $rolePermissions = $role->permissions
            ->pluck('name')
            ->toArray();

        return view(
            'Admin.roles.edit',
            compact(
                'role',
                'permissions',
                'rolePermissions'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Role
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $role = Role::where('guard_name', 'web')
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
        ]);

        // Don't allow Admin role name to be changed
        if ($role->name === 'Admin') {

            $role->syncPermissions(
                Permission::where('guard_name', 'web')->get()
            );

            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Admin permissions updated successfully.');
        }

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions(
            $request->permissions ?? []
        );

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Role
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $role = Role::where('guard_name', 'web')
            ->findOrFail($id);

        // Admin role cannot be deleted
        if ($role->name === 'Admin') {

            return redirect()
                ->route('admin.roles.index')
                ->with('error', 'Admin role cannot be deleted.');
        }

        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}