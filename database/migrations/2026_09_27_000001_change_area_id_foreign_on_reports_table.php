<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }
};