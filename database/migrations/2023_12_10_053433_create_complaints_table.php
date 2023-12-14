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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->nullable()->constrained();
            $table->integer('user_id')->nullable()->constrained();
            $table->integer('assigned_staff_user_id')->nullable()->constrained();
            $table->string('title');
            $table->date('observed_date');
            $table->text('details');
            $table->date('completed_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
