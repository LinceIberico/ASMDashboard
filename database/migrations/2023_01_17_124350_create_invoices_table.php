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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('identifier');
            // $table->foreignId('client_invoice_id')->constrained('client_invoice');
            // $table->foreignId('invoice_product_id')->constrained('invoice_product');
            // $table->foreignId('cart_product_id')->constrained('cart_product');
            $table->foreignId('cart_id')->constrained('carts')->nullable();
            $table->foreignId('payment_id')->constrained('payments')->nullable();
            $table->integer('iva')->default(21);
            $table->float('total',8,2);
            $table->enum('status', ['pendiente', 'pagada', 'rechazada'])->default('pendiente');
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
        Schema::dropIfExists('invoices');
    }
};
