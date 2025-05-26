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
        Schema::create('finance_expenses', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('expense_no')->unique();
            $table->date('expense_date');

            $table->bigInteger("expense_type_id")->nullable();
            $table->foreign("expense_type_id")->references("id")->on("expense_types");

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
        Schema::dropIfExists('finance_expenses');
    }
};
