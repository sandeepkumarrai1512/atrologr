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
        Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->string('small_description');
    $table->string('category');
    $table->string('model');
    $table->year('manufacturing_year');
    $table->string('make');
    $table->string('condition');
    $table->decimal('price', 10, 2);
    $table->integer('quantity');
    $table->text('detail_description');
    $table->text('feature')->nullable();
    $table->text('images'); // store image names as JSON or comma-separated
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
