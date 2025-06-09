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
        Schema::create('transaction_headers', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('trs_no')->unique();
            $table->date('trs_date');

            $table->bigInteger("work_type_id")->nullable();
            $table->foreign("work_type_id")->references("id")->on("work_types");
            $table->bigInteger("order_type_id")->nullable();
            $table->foreign("order_type_id")->references("id")->on("order_types");
            $table->string("payment_type");

            $table->string("customer_fullname");
            $table->string("address");
            $table->string("no_telp");
            $table->string('vehicle_number');

            $table->integer('total_price');
            $table->string('note');

            $table->integer('flag');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_headers');
    }
};
