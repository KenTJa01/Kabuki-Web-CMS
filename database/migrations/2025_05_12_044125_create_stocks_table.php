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
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("item_id");
            $table->foreign("item_id")->references("id")->on("items");
            $table->string("item_code", 100);
            $table->float("quantity");
            $table->integer("so_flag")->default(0);
            $table->timestamps();
            $table->bigInteger("created_by");
            $table->bigInteger("updated_by");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
