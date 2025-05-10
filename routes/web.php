<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImprovementPlanController;
use App\Http\Controllers\WorkPlanController;
use App\Models\WorkPlan;
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


Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:ADMIN'])->group(function () {
        Route::get('/', [HomeController::class, 'root'])->name('root');
        Route::get('/user-edit', [UserController::class, 'index'])->name('userEdit');
        Route::post('/user-update', [UserController::class, 'update'])->name('userUpdate');
        Route::get('/user-register', [UserController::class, 'showRegistrationFormAdmin'])->name('userRegister');

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
        Route::get('/', [HomeController::class, 'root'])->name('root');
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
        Route::post('/audit-complement', [AuditController::class, 'complementAudit'])->name('audit.complement');



        Route::resource('improvement-plan', ImprovementPlanController::class);
        Route::get('improvement-plan-generate/{assessment_id}', [ImprovementPlanController::class, 'generateImprovementPlan'])->name('improvement.generate');
        Route::get('improvement-plan-datatable', [ImprovementPlanController::class, 'datatableImprovement'])->name('improvement.datatable');
        Route::get('improvement-plan-answer/{assessment_id}', [ImprovementPlanController::class, 'indexAnswer'])->name('improvement.answer');
        Route::get('improvement-plan-datatable-details/{assessment_id}', [ImprovementPlanController::class, 'datatableImprovementDetails'])->name('improvement.details');
        Route::get('improvement-plan-word/{assessment_id}', [ImprovementPlanController::class, 'generateWordImprovementPlan'])->name('improvement.word');

        Route::resource('work-plan', WorkPlanController::class);
        Route::post('work-plan-generate/{assessment_id}', [WorkPlanController::class, 'generateWorkPlan'])->name('work.plan.generate');
        Route::get('work-plan-datatable', [WorkPlanController::class, 'datatableWorkPlan'])->name('work.plan.datatable');
        Route::get('work-plan-answer/{assessment_id}', [WorkPlanController::class, 'indexAnswer'])->name('work.plan.answer');
        Route::get('work-plan-datatable-details/{work_plan_id}', [WorkPlanController::class, 'datatableWorkPlanDetails'])->name('work.plan.details');
        Route::get('work-plan-resume/{work_plan_id}', [WorkPlanController::class, 'dataResumeWorkPlan'])->name('work.plan.resume');
        Route::get('work-plan-word/{assessment_id}', [WorkPlanController::class, 'generateWordWorkPlan'])->name('work.plan.word');


        Route::post('/ask-assistant', [AssistantController::class, 'ask']);
    });
});

// Route::post('/chat', [ChatBotController::class, 'ask'])->name('chat.ask');

// Route::get('assessment', [AuditController::class, 'assessment'])->name('audit.assessment');
// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->withoutMiddleware(['auth']);
