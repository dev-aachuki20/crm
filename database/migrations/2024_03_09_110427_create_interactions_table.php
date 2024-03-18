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
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->datetime('registration_at')->nullable();
            $table->unsignedBigInteger('lead_id');
            $table->string('phone')->nullable();
            $table->string('qualification')->nullable();
            $table->text('customer_observation')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=> active, 0=>deactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
