<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Show the form for creating the resource.
     */

    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('admin.permissions.index', compact('permissions'));
    }
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3']
        ]);

        Permission::create($validated);
        return to_route('admin.permissions.index')->with(['message' => 'Se ha Creado el Permiso correctamente!']);;
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3']
        ]);

        $permission->update($validated);
        return to_route('admin.permissions.index')->with(['message' => 'Se ha Actualizado el Permiso correctamente!']);
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return to_route('admin.permissions.index')->with(['message' => 'Se ha Eliminado el Permiso correctamente!']);
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            return back()->with(['message' => 'El Rol ya se encuentra asignado']);
        }
        $permission->assignRole($request->role);
        return back()->with(['message-success' => 'Se ha asignado el Rol']);
    }

    public function removeRole(Permission $permission, Request $request)
    {
        if ($permission->hasRole($request->role)) {
            $permission->removeRole($request->role);
            return back()->with(['message-success' => 'El Rol se ha retirado']);
        }

        return back()->with(['message' => 'El Rol No existe']);
    }
}
