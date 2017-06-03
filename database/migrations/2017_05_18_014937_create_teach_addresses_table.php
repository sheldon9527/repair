<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('repairs')) {
            Schema::create('repairs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 45)->index();
                $table->string('build_number', 255);
                $table->string('home_number', 255);
                $table->string('phone', 255);
                $table->enum('status', ['PEND','PENDING','ACTIVE', 'INACTIVE','FINISH'])->default('PEND')->index();
                $table->enum('build_type', ['MAN', 'WOMEN'])->index();
                $table->text('description');
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
