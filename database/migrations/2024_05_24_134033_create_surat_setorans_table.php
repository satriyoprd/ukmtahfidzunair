<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained()->onDelete('cascade');
            $table->foreignId('setoran_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_setorans');
    }
};
