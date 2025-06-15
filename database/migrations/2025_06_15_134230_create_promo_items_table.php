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
        Schema::create('promo_items', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("promo_id");
            $table->foreign("promo_id")->references("id")->on("promos");
            $table->bigInteger("item_id");
            $table->foreign("item_id")->references("id")->on("items");
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
        Schema::dropIfExists('promo_items');
    }
};
