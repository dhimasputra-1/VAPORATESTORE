<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->enum('payment_status', ['pending', 'paid'])->default('pending')->after('total_price');
        $table->string('payment_proof')->nullable()->after('payment_status');
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn(['payment_status', 'payment_proof']);
    });
}
};
