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
        if (Schema::hasTable('articles')) {
            Schema::dropIfExists('images');
        }

        Schema::create('images', function (Blueprint $table) {
            $table->integer('image_id')->unsigned()->autoIncrement();
            $table->string('image_path', 255)->charset('utf8mb3')->collation('utf8mb3_general_ci')->default('');
            $table->integer('image_x')->default(0);
            $table->integer('image_y')->default(0);
            $table->char('is_high_res', 1)->charset('utf8mb3')->collation('utf8mb3_general_ci')->default('N');
            $table->engine = 'MyISAM';
            $table->index('image_path', 'image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
