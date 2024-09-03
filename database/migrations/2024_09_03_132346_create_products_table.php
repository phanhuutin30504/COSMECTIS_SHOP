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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode', 13);
            $table->string('sku', 20);
            $table->string('name', 300);
            $table->integer('price');
            $table->integer('discount_percentage');
            $table->date('discount_from_date');
            $table->date('discount_to_date');
            $table->string('featured_image', 100);
            $table->integer('inventory_qty');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id')->nullable();
            $table->dateTime('created_date');
            $table->text('description');
            $table->float('star')->nullable();
            $table->tinyInteger('featured')->nullable()->comment('1: nổi bật');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
