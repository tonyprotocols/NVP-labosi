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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('naziv_rada');
            $table->string('naziv_rada_en');
            $table->string('zadatak_rada');
            $table->enum('tip_studija',['stručni','preddiplomski','diplomski'])->default('preddiplomski');
            $table->string('nastavnik');
            $table->json('studenti')->default('[]');
            $table->string('izabrani_student')->nullable();
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
        Schema::dropIfExists('tasks');
    }
};
