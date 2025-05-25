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
        Schema::create('receiving_details', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("rec_id");
            $table->foreign("rec_id")->references("id")->on("receiving_headers");

            $table->bigInteger("item_id");
            $table->foreign("item_id")->references("id")->on("items");
            $table->string("item_code", 100);
            $table->string("item_desc", 255);

            $table->float("unit_price")->default(0);
            $table->float("quantity");

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
        Schema::dropIfExists('receiving_details');
    }
};
