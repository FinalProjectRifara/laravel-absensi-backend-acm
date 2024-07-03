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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('cuti')->default(10)->after('email');
        });

        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            // user_id is a foreign key that references the id column on the users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Date permission is a date column
            $table->date('date_cuti');
            // Reason
            $table->text('reason');
            // image
            $table->string('image')->nullable();
            // is_approved is a boolean column
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cuti');
        });
        
        Schema::dropIfExists('cutis');
    }
};
