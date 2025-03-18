<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use App\Models\PersonType;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        $document_type = DocumentType::all();
        $person_type = PersonType::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.role', compact('user', 'roles', 'document_type', 'person_type', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function  assignRoleToUser(User $user, Request $request)
    {
        // dd($user->hasRole($request->role));
        if ($user->hasRole($request->role)) {
            return back()->with(['message' => 'El Rol ya se encuentra asignado']);
        }
        $user->assignRole($request->role);
        return back()->with(['message-success' => 'Se ha asignado el Rol']);
    }

    public function removeRoleToUser(User $user, Request $request)
    {
        if ($user->hasRole($request->role)) {
            $user->removeRole($request->role);
            return back()->with(['message' => 'El Rol ha sido eliminado']);
        }
        return back()->with(['message-success' => 'El rol no se encuentra asignado']);
    }


    public function givePermissionToUser(User $user, Request $request)
    {

        if ($user->hasPermissionTo($request->permission)) {
            return back()->with(['message-success' => 'El Permiso ya se encuentra asignado']);
        }

        $user->givePermissionTo($request->permission);
        return back()->with(['message' => 'El Permiso ha sido creado']);
    }

    public function revokePermissionToUser(User $user, Request $request)
    {

        if ($user->hasPermissionTo($request->permission)) {
            $user->revokePermissionTo($request->permission);
            return back()->with(['message' => 'El Permiso ha sido eliminado']);
        }
        return back()->with(['message-success' => 'El Permiso no se encuentra asignado']);
    }
}
