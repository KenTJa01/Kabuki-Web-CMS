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
        Schema::create('customers', function (Blueprint $table) {

            $table->bigIncrements("id");
            $table->string("customer_code", 15)->unique();
            $table->string('customer_name');
            $table->string('no_telp');
            $table->string('address');
            $table->string('vehicle_type');
            $table->string('vehicle_no');
            $table->integer("flag")->default(1);
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
        Schema::dropIfExists('customers');
    }
};
