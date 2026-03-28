<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->foreignId('grupo_id')->nullable()->after('user_id');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
        });
        
        // Asignar todas las tareas existentes al primer grupo (ID: 1)
        \Illuminate\Support\Facades\DB::table('assignments')->update(['grupo_id' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropForeign(['grupo_id']);
            $table->dropColumn('grupo_id');
        });
    }
};
