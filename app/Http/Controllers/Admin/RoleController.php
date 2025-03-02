<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3']
        ]);

        Role::create($validated);
        return to_route('admin.roles.index')->with(['message' => 'Se ha Creado el rol correctamente!']);;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3']
        ]);
        $role->update($validated);
        return to_route('admin.roles.index')->with(['message' => 'Se ha Actualizado el rol correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return to_route('admin.roles.index')->with(['message' => 'Se ha Eliminado el rol correctamente!']);
    }

    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with(['message' => 'El permiso ya se encuentra asignado']);
        }
        $role->givePermissionTo($request->permission);
        return back()->with(['message-success' => 'Se ha asignado el permiso']);
    }

    public function revokePermission(Role $role, Request $request)
    {
        if ($role->hasPermissionTo($request->permission)) {
            $role->revokePermissionTo($request->permission);
            return back()->with(['message-success' => 'El permiso se ha retirado']);
        }

        return back()->with(['message' => 'El permiso No existe']);
    }
}
