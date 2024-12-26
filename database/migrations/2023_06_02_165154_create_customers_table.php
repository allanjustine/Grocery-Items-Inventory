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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_category_id');
            $table->string('cust_name');
            $table->string('cust_address');
            $table->string('cust_number');
            $table->string('cust_money');
            $table->string('cust_change')->default(0);
            $table->timestamps();
            $table->foreign('item_category_id')->references('id')->on('item_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
