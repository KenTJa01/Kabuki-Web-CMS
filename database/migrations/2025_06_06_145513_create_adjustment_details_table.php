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
        Schema::create('adjustment_details', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('adj_id');
            $table->foreign("adj_id")->references("id")->on("adjustment_headers");

            $table->bigInteger('item_id');
            $table->foreign("item_id")->references("id")->on("items");
            $table->string('item_code', 100);

            $table->string('item_desc');
            $table->float('adj_qty');
            $table->float('stock_before_adj');
            $table->float('stock_after_adj');

            $table->string('reason');

            $table->unique(['adj_id', 'item_id']);
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
        Schema::dropIfExists('adjustment_details');
    }
};
