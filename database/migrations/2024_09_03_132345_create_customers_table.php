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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('password', 60); // Changed to 60 for bcrypt hashing
            $table->string('mobile', 15);
            $table->string('email', 100);
            $table->string('login_by', 20);
            $table->string('ward_id', 5)->nullable();
            $table->string('shipping_name', 200);
            $table->string('shipping_mobile', 15);
            $table->string('housenumber_street', 200)->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
