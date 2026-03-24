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
    Schema::table('users', function (Blueprint $table) {
        $table->string('phone')->nullable();
        $table->string('company_name')->nullable();
        $table->string('gst_number')->nullable();
        $table->text('address')->nullable();
        $table->string('state')->nullable();
        $table->string('pin_code')->nullable();
        $table->string('status')->nullable(); // 1 = Active, 0 = Inactive
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['phone', 'company_name', 'gst_number', 'address', 'state', 'pin_code', 'status']);
    });
}

};
