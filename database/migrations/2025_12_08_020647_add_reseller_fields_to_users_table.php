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
        Schema::table('users', function (Blueprint $table) {
            // Kita buat nullable agar Admin tidak wajib punya data ini
            $table->string('shop_name')->nullable()->after('name'); // Nama Toko
            $table->string('phone')->nullable()->after('email');     // No HP/WA
            $table->string('domicile')->nullable()->after('phone');  // Kota/Domisili
            $table->text('address')->nullable()->after('domicile');  // Alamat Lengkap
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
