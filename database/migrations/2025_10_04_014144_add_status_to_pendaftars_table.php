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
       
        Schema::table('pendaftars', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftars', 'status')) {
                $table->enum('status', ['pending', 'accepted', 'rejected'])
                      ->default('pending')
                      ->after('created_at'); // bisa dipindahkan sesuai kebutuhan
            }
        });
    }

    /**
     * Reverse the migrations.
     */

   public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftars', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
