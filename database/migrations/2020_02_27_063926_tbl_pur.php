<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pur', function (Blueprint $table) {
            $table->increments('pur_id');
            $table->string('v_name');
            $table->string('p_code');
            $table->string('p_description');
            $table->string('per_p_price');
            $table->string('p_quantity');
            $table->string('a_quantity');
            $table->string('discount');
            $table->string('p_total_price');
            $table->string('delivary_status');
            $table->string('p_image');
            $table->string('payment_status');
            $table->string('partial_payment');
            $table->string('remaining_due');
            $table->string('purchase_date');
          
           
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
        //
    }
}
