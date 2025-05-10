<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use App\Models\PersonType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function showRegistrationFormAdmin()
    {
        $document_type = DocumentType::all();
        $person_type = PersonType::all();
        return view('admin.users.create', compact('document_type', 'person_type'));
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'document_type_id' => 'required|exists:document_types,id',
            'person_type_id' => 'required|exists:person_types,id',
            'identification' => 'required|string|max:20',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'cellphone' => 'required|string|max:20',
            'professional_card' => 'required|string|max:50',
            'department' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'neighborhood' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->fill($request->except('password'));

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', "El usuario ha sido eliminado exitosamente.");
    }

    public function  assignRoleToUser(User $user, Request $request)
    {
        // dd($user->hasRole($request->role));
        if ($user->hasRole($request->role)) {
            return back()->with(['message-rol' => 'El Rol ya se encuentra asignado']);
        }
        $user->assignRole($request->role);
        return back()->with(['message-success-rol' => 'Se ha asignado el Rol']);
    }

    public function removeRoleToUser(User $user, Request $request)
    {
        if ($user->hasRole($request->role)) {
            $user->removeRole($request->role);
            return back()->with(['message-success-rol' => 'El Rol ha sido eliminado']);
        }
        return back()->with(['message-success-rol' => 'El rol no se encuentra asignado']);
    }


    public function givePermissionToUser(User $user, Request $request)
    {

        if ($user->hasPermissionTo($request->permission)) {
            return back()->with(['message' => 'El Permiso ya se encuentra asignado']);
        }

        $user->givePermissionTo($request->permission);
        return back()->with(['message-success' => 'El Permiso ha sido asignado']);
    }

    public function revokePermissionToUser(User $user, Request $request)
    {

        if ($user->hasPermissionTo($request->permission)) {
            $user->revokePermissionTo($request->permission);
            return back()->with(['message-success' => 'El Permiso ha sido eliminado']);
        }
        return back()->with(['message' => 'El Permiso no se encuentra asignado']);
    }


    public function editSignature(User $user)
    {
        return view('admin.users.signature.index', compact('user'));
    }

    public function updateSignature(Request $request, User $user)
    {
        if ($request->hasFile('sign')) {
            $file = $request->file('sign');

            // Obtener la extensión original del archivo (por ejemplo: png, jpg)
            $extension = $file->getClientOriginalExtension();

            // Crear un nombre de archivo con el ID del usuario
            $filename = $user->id . '.' . $extension;

            // Guardar el archivo en 'public/signature' con el nombre 'ID.ext'
            $path = $file->storeAs('signature', $filename, 'public');

            // Eliminar firma anterior si existe (solo si el nombre cambia)
            if ($user->sign_path && $user->sign_path !== $path && Storage::disk('public')->exists($user->sign_path)) {
                Storage::disk('public')->delete($user->sign_path);
            }

            // Actualizar la ruta en la base de datos
            $user->sign_path = $path;
            $user->save();

            return back()->with('success', 'Firma actualizada correctamente.');
        }

        return back()->with('error', 'No se ha subido ninguna firma.');
    }

    public function editProfile(User $user)
    {
        $document_type = DocumentType::all();
        $person_type = PersonType::all();
        return view('admin.users.edit', compact('user', 'document_type', 'person_type'));
    }
}
