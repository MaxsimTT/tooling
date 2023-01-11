<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100)->charset('utf8mb3')->collation('utf8mb3_general_ci')->default(' ');
                $table->bigInteger('user_id')->unsigned()->foreign('user_id')->references('id')->on('users');
                $table->text('description')->charset('utf8mb3')->collation('utf8mb3_general_ci');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('posts')) {
            Schema::dropIfExists('posts');
        }
    }
};
