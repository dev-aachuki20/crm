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
            $table->uuid();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('identification')->nullable();
            $table->date('birthdate')->nullable();
            $table->tinyInteger('gender')->nullable()->comment(' 1 => male, 2 => female, 3 => other');
            $table->tinyInteger('civil_status')->nullable()->comment(' 1 => single, 2 => married, 3 => divorced, 4 => widower, 5=>free union');
            $table->string('province', 100)->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('sector', 100)->nullable();
            $table->string('reference', 100)->nullable();
            $table->tinyInteger('employment_status')->nullable()->comment('1=>employee, 2=>unemployed, 3=>dependent, 4=>independent, 5=>retired, 6=>own business, 7=>rentier');
            $table->tinyInteger('social_security')->nullable()->comment('1=>si, 2=>no');
            $table->string('company_name')->nullable();
            $table->string('occupation')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('campaign_id')->references('id')->on('campaigns');
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
