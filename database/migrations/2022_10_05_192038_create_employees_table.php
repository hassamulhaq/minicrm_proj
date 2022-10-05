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
            $table->string('email', 200)->unique()->nullable();
            $table->string('phone', 15)->nullable();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
