<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('categoryId')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subCategoryId')->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('childCategoryId')->constrained('child_categories')->onDelete('cascade');
            $table->text('shortDescription')->nullable();
            $table->text('longDescription')->nullable();
            $table->decimal('current_price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('product_code')->unique();
            $table->string('image')->nullable();
            $table->string('galary_id')->nullable();
            $table->string('videoUrl')->nullable();
            $table->integer('stock_qty')->default(0);
            $table->integer('sold_qty')->default(0);
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('color')->nullable();
            $table->string('measurement')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
