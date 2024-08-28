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
        Department::create(['name' => 'Nutrition and Dietetics', 'description' => 'Dietitians and nutritionists provide specialist advice on diet for hospital wards and outpatient clinics.']);
        Department::create(['name' => 'Gynecology', 'description' => 'Specialist nurses, midwives, and imaging technicians provide maternity services such as antenatal and postnatal care, maternal and fetal surveillance, and prenatal diagnosis.']);
        Department::create(['name' => 'Oncology', 'description' => 'A branch of medicine that deals with cancer and tumors. A medical professional who practices oncology is an oncologist. The Oncology department provides treatments, including radiotherapy and chemotherapy, for cancerous tumors and blood disorders.']);
        Department::create(['name' => 'Pharmacy', 'description' => 'Responsible for drugs in a hospital, including purchasing, supply, and distribution.']);
        Department::create(['name' => 'Urology', 'description' => 'The urology department is run by consultant urology surgeons and investigates areas linked to kidney and bladder conditions.']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department');
    }
};
