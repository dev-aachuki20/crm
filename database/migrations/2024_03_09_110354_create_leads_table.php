<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            $table->datetime('registration_at')->nullable();

            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();

            $table->string('phone',50)->nullable();
            $table->string('cellphone',50)->nullable();

            $table->integer('identification',10)->nullable();
            $table->date('birthdate')->nullable();
            $table->tinyInteger('gender')->nullable()->comment(' 1 => male, 2 => female, 3 => other');
            $table->tinyInteger('civil_status')->nullable()->comment(' 1 => single, 2 => married, 3 => divorced, 4 => widower');

            $table->string('province',100)->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->string('sector',100)->nullable();
            $table->string('reference',100)->nullable();


            $table->tinyInteger('employment_status')->nullable()->comment('1=>employee, 2=>unemployed');
            $table->tinyInteger('social_security')->nullable()->comment('1=>si, 2=>no');
           
            $table->string('company_name')->nullable();
            $table->string('occupation')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
