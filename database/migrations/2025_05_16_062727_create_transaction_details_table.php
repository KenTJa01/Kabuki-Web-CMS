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
        Schema::create('transaction_details', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('trs_id');
            $table->foreign("trs_id")->references("id")->on("transaction_headers");

            $table->bigInteger('item_id');
            $table->foreign("item_id")->references("id")->on("items");
            $table->string('item_code', 100);
            $table->string('item_desc');

            $table->float('quantity');
            $table->integer('total_price_per_item');

            $table->unique(['trs_id', 'item_id']);

            $table->timestamps();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
