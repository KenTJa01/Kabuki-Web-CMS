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
        Schema::create('receiving_headers', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("rec_no")->unique();
            $table->date("rec_date");

            $table->string("supp_name")->nullable();
            $table->string("invoice_no")->nullable();

            $table->integer('flag');
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
        Schema::dropIfExists('receiving_headers');
    }
};
