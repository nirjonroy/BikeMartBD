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
    Schema::create('sub_categories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cat_id')->nullable()->constrained('categories')->onDelete('cascade');
        $table->string('name')->nullable();
        $table->string('slug')->unique();
        $table->string('image')->nullable();
        $table->string('priority')->nullable();
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
        Schema::dropIfExists('sub_categories');
    }
};
