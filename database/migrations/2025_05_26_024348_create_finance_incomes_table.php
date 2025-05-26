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
        Schema::create('finance_incomes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('income_no')->unique();
            $table->date('income_date');

            $table->bigInteger("income_type_id")->nullable();
            $table->foreign("income_type_id")->references("id")->on("income_types");

            $table->bigInteger('amount');
            $table->string('description');

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
        Schema::dropIfExists('finance_incomes');
    }
};
