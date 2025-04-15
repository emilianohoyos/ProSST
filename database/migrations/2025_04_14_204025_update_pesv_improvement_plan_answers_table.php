<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pesv_improvement_plan_answers', function (Blueprint $table) {
            $table->dropForeign(['pesv_cause_improvement_plan_id']);

            // 1. Eliminar el campo antiguo (si existe)
            if (Schema::hasColumn('pesv_improvement_plan_answers', 'state_action')) {
                $table->dropColumn('state_action');
            }

            if (Schema::hasColumn('pesv_improvement_plan_answers', 'action_was_effective')) {
                $table->dropColumn('action_was_effective');
            }
            if (Schema::hasColumn('pesv_improvement_plan_answers', 'pesv_cause_improvement_plan_id')) {
                $table->dropColumn('pesv_cause_improvement_plan_id');
            }

            // 2. Agregar el nuevo campo de observación
            $table->text('observation')->nullable();
            $table->date('execution_date')->nullable();
            $table->foreignId('status_action_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('improvement_action_id')->nullable()->constrained()->onDelete('set null');
            $table->text('people_to_be_informed')->nullable()->change();
            $table->text('channel_diffusion_improvement_action')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesv_improvement_plan_answers', function (Blueprint $table) {
            // 1. Eliminar la llave foránea primero
            $table->dropForeign(['status_action_id']);
            $table->dropForeign(['improvement_action_id']);
            // $table->dropForeign(['pesv_cause_improvement_plan_id']);

            // 2. Eliminar el campo observation
            $table->dropColumn('observation');
            $table->dropColumn('execution_date');
        });
    }
};
