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
        Schema::create('core_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Add the 'name' column for permissions
            // Add other columns as needed for permissions
            $table->timestamps();
        });

        Schema::create('core_permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
            
            // Define foreign keys
            $table->foreign('permission_id')->references('id')->on('core_permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('core_roles')->onDelete('cascade');
            
            // Define unique combination of permission_id and role_id
            $table->unique(['permission_id', 'role_id']);
            
            // Add indexes
            $table->index(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_permission_role');
        Schema::dropIfExists('core_permissions');
    }
};
