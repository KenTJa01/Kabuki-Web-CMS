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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->date("mov_date");

            $table->bigInteger("item_id");
            $table->foreign("item_id")->references("id")->on("items");
            $table->string("item_code", 100);

            $table->float("quantity");

            $table->string("mov_code");
            $table->foreign("mov_code")->references("mov_code")->on("movement_types");

            $table->string("ref_no");
            $table->float("purch_price")->default(0);
            $table->float("sales_price")->default(0);

            $table->bigInteger("created_by");
            $table->bigInteger("updated_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
