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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('dni',25)->unique()->nullable();
            $table->string('name',50)->nullable();
            $table->string('surname',50)->nullable();
            $table->integer('phone')->nullable();
            $table->string('first_address',100)->nullable();
            $table->string('second_address',100)->nullable();
            $table->string('city',50)->nullable();
            $table->string('postal_code',12)->nullable();
            $table->string('country',50)->nullable();
            $table->foreignId('user_id')->constrained('users')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
