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
        //$table->string('payment_channel')->nullable()->after('payment_method');
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn('payment_channel');
    });
}

};
