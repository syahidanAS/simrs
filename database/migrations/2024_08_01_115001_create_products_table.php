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
            $table->string('code')->nullable();
            $table->string('industry_id')->nullable();
            $table->string('name')->nullable();
            $table->string('content')->nullable();
            $table->bigInteger('large_unit_id')->nullable();
            $table->bigInteger('fill')->nullable();
            $table->bigInteger('small_unit_id')->nullable();
            $table->bigInteger('capacity')->nullable();
            $table->bigInteger('type_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('group_id')->nullable();
            $table->bigInteger('current_stock')->nullable();
            $table->bigInteger('minimum_stock')->nullable();
            $table->decimal('basic_price', 15, 2)->nullable();
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->decimal('outpatient_price', 15, 2)->nullable();
            $table->decimal('inpatient_price_class_1', 15, 2)->nullable();
            $table->decimal('inpatient_price_class_2', 15, 2)->nullable();
            $table->decimal('inpatient_price_class_3', 15, 2)->nullable();
            $table->decimal('inpatient_price_bpjs', 15, 2)->nullable();
            $table->decimal('inpatient_price_vip', 15, 2)->nullable();
            $table->decimal('inpatient_price_vvip', 15, 2)->nullable();
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
