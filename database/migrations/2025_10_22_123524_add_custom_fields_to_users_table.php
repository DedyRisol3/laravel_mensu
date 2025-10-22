<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ganti 'name' menjadi 'fullname' agar sesuai HTML Anda
            $table->renameColumn('name', 'fullname'); 

            // Tambahkan kolom baru
            $table->string('no_hp')->nullable()->after('email');
            $table->text('alamat')->nullable()->after('no_hp');
            $table->string('role')->default('pelanggan')->after('alamat'); 
            // Role: pelanggan, admin, kurir
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('fullname', 'name');
            $table->dropColumn(['no_hp', 'alamat', 'role']);
        });
    }
};