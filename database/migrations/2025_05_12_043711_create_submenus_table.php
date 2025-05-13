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
        Schema::create('submenus', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("menu_id");
            $table->foreign("menu_id")->references("id")->on("menus");
            $table->string("submenu_name");
            $table->string("submenu_url");
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
        Schema::dropIfExists('submenus');
    }
};
