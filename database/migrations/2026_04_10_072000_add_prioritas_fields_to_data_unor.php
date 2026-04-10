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
        if (Schema::hasTable('data_unor')) {
            Schema::table('data_unor', function (Blueprint $table) {
                if (!Schema::hasColumn('data_unor', 'is_prioritas_nasional')) {
                    $table->boolean('is_prioritas_nasional')->nullable()->after('jabatan_prioritas');
                }
                if (!Schema::hasColumn('data_unor', 'is_prioritas_instansi')) {
                    $table->boolean('is_prioritas_instansi')->nullable()->after('is_prioritas_nasional');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('data_unor')) {
            Schema::table('data_unor', function (Blueprint $table) {
                $table->dropColumn(['is_prioritas_nasional', 'is_prioritas_instansi']);
            });
        }
    }
};
