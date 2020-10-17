<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('DOB')->nullable();
            $table->string('company_name', 100);
            $table->string('position', 100);
            $table->string('email', 255)->nullable(); // length consistent with users table
            /**
             * 1..N phone_numbers
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
