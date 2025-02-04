<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); //means if the user deleted then their listing are deleted as well
            $table->string('title');
            $table->text('desc');
            // id to text column are required

            $table->string('tags')->nullable();
            $table->string('email')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            
            $table->boolean('approved')->default(false);
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
