<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. HRIS, E-Office, E-Leave
            $table->string('slug')->unique(); 
            $table->string('url')->nullable(); // target url aplikasi
            $table->string('icon')->nullable(); // bi bi-...
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
