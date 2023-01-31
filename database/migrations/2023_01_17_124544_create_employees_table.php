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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('dni',25)->nullable();
            $table->string('name',50)->nullable();
            $table->string('surname',50)->nullable();
            $table->integer('phone_1')->nullable();
            $table->integer('phone_2')->nullable();
            $table->string('address_1',100)->nullable();
            $table->string('address_2',100)->nullable();
            $table->string('city',50)->nullable();
            $table->string('postal_code',12)->nullable();
            $table->string('country',50)->nullable();
            $table->enum('status', ['activo', 'inactivo', 'despido', 'vacaciones'])->default('activo');
            $table->datetime('start_holydays')->nullable();
            $table->datetime('end_holydays')->nullable();
            $table->foreignId('user_id')->constrained('users');
            // $table->foreignId('workdays_id')->constrained('workdays');
            $table->timestamps();
            $table->softDeletes();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
