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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name')->nullable();
            // $table->string('assigned_channel')->nullable();

            $table->unsignedBigInteger('assigned_channel')->nullable();
            $table->foreign('assigned_channel')->references('id')->on('channels')->onDelete('cascade');

            /* $table->string('qualification')->nullable();
            $table->text('qualification_comment')->nullable(); */
            $table->text('description')->nullable();
            $table->enum('status', ['0','1'])->default(0)->comment('1 means active, 0 means inactive');
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
