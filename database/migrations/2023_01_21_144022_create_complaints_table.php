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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string("full_name");
            $table->string("phone_number");
            $table->string("category");
            $table->string("description");
            $table->double('latitude');
            $table->double('longitude');
            $table->enum('status', ['Pending', 'Work In Progress', 'Resolved']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
};
