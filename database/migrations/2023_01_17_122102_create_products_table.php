<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->constrained('product_categories');
            $table->string('label',150);
            $table->float('high')->nullable();
            $table->float('width')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->float('price',8,2)->default(0.0);
            $table->integer('discount')->nullable();
            $table->integer('quantity')->default(0);
            $table->boolean('available')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
