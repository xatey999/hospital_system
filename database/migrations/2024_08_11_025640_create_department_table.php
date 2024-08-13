<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Department;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('department', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        Department::create(['name' => 'Cardiology', 'description' => 'Heart and blood vessels']);
        Department::create(['name' => 'Neurology', 'description' => 'Nervous system and brain']);
        Department::create(['name' => 'Orthopedics', 'description' => 'Bones and muscles']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department');
    }
};
