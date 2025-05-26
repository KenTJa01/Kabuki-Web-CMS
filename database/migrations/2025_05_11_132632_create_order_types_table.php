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
        Schema::create('order_types', function (Blueprint $table) {

            $table->bigIncrements("id");
            $table->string("order_type_code", 15)->unique();
            $table->string("order_type_name");
            $table->string("order_type_desc");

            $table->bigInteger("work_type_id")->nullable();
            $table->foreign("work_type_id")->references("id")->on("work_types");

            $table->integer("flag")->default(1);
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
        Schema::dropIfExists('order_types');
    }
};
