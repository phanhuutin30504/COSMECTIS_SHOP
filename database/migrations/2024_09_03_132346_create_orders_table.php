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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_date');
            $table->tinyInteger('order_status_id');
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('customer_id');
            $table->string('shipping_fullname', 100);
            $table->string('shipping_mobile', 15);
            $table->tinyInteger('payment_method')->default(0)->comment('0:COD, 1: bank');
            $table->string('shipping_ward_id', 5)->nullable();
            $table->string('shipping_housenumber_street', 200);
            $table->integer('shipping_fee')->default(0);
            $table->date('delivered_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
