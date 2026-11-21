<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->integer('uang_bayar')->default(0)->after('total_harga');$table->integer('kembalian')->default(0)->after('uang_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {$table->dropColumn(['uang_bayar', 'kembalian']);
        });
    }
};