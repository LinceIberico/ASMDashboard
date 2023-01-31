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
        Schema::create('workdays', function (Blueprint $table) {
            $table->id();
            $table->string('label',50);
            $table->text('description',150)->nullable();
            $table->time('start_day');
            $table->time('end_day');
            $table->time('rest')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->foreignId('workday_category_id')->constrained('workday_categories');
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
        Schema::dropIfExists('workdays');
    }
};
