<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('email')->unique()->nullable();
            $table->string('phone', 30)->nullable();
            $table->foreignUuid('company_id')->nullable();

            $table->timestamps();


            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
