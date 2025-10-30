<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('basic_documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // add columns as needed later
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('basic_documents');
    }
};
