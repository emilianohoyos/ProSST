<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes(['verify' => true]);


Route::middleware(['auth', 'verified', 'role:ADMIN'])->group(function () {
    Route::middleware(['role:ADMIN'])->group(function () {
        Route::get('/', [HomeController::class, 'root']);
        Route::get('/user-edit', [UserController::class, 'index'])->name('userEdit');
        Route::post('/user-update', [UserController::class, 'update'])->name('userUpdate');

        Route::resource('/roles', RoleController::class);
        Route::post('/role/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
        Route::delete('/role/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
        Route::resource('/permissions', PermissionController::class);
        Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
        Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
        // 
        Route::post('/users/{user}/roles', [UserController::class, 'assignRoleToUser'])->name('users.roles.assign');
        Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRoleToUser'])->name('users.roles.remove');

        Route::post('/users/{user}/permissions', [UserController::class, 'givePermissionToUser'])->name('users.permissions.give');
        Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermissionToUser'])->name('users.permissions.revoke');
    });
    Route::middleware(['role:ADMIN|USUARIO'])->group(function () {
        Route::get('/', [HomeController::class, 'root']);
        Route::resource('client', ClientController::class);
        Route::get('/client-users/{id}', [ClientController::class, 'clientUserData'])->name('client.users');
        Route::put('/client-users-update/{id}', [ClientController::class, 'clientUserUpdate'])->name('client.users.update');
        Route::delete('/users-client/{userClientId}', [UserController::class, 'clientUserDelete'])->name('users.clients.delete');

        Route::get('/users/profile/{user}', [UserController::class, 'editProfile'])->name('users.editProfile');

        Route::get('/users/{user}/signature', [UserController::class, 'editSignature'])->name('users.editSignature');
        Route::put('/users/{user}/signature', [UserController::class, 'updateSignature'])->name('users.updateSignature');

        Route::resource('audit', AuditController::class);
        Route::get('audit-datatable', [AuditController::class, 'datatableAuditoria'])->name('audit.datatable');
        Route::get('audit-datatable-steps/{application_level}/{assessment_id}', [AuditController::class, 'datatablePasos'])->name('audit.datatable.steps');
        Route::get('audit-step-questions/{assessment_id}/{step_id}', [AuditController::class, 'diligenciarPreguntas'])->name('audit.step.questions');
        Route::post('audit-save-questions', [AuditController::class, 'guardarRespuestaIndividual'])->name('audit.save.single.response');
        Route::post('/audit/finalize', [AuditController::class, 'finalizeAudit'])->name('audit.finalize');
        Route::get('/audit-inform/{auditoria_id}', [AuditController::class, 'generarInformePESV'])->name('audit.inform');
        Route::get('/audit-resume/{auditoria_id}', [AuditController::class, 'indexResumenAuditoria'])->name('audit.resume');
    });
});

Route::post('/chat', [ChatBotController::class, 'ask'])->name('chat.ask');

Route::get('assessment', [AuditController::class, 'assessment'])->name('audit.assessment');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->withoutMiddleware(['auth']);
