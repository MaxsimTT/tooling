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
        if (Schema::hasTable('images_links')) {
            Schema::dropIfExists('images_links');
        }

        Schema::create('images_links', function (Blueprint $table) {
            $table->unsignedMediumInteger('pair_id')->autoIncrement();
            $table->integer('object_id')->unsigned()->default(0);
            $table->string('object_type', 24)->charset('utf8mb3')->collation('utf8mb3_general_ci')->default('');
            $table->integer('image_id')->unsigned()->default(0);
            $table->integer('detailed_id')->unsigned()->default(0);
            $table->char('type', 1)->charset('utf8mb3')->collation('utf8mb3_general_ci')->default('M');
            $table->integer('position')->default(0);
            $table->timestamps();
            $table->engine = 'MyISAM';
            $table->index(['object_id', 'object_type', 'type'], 'object_id');
            $table->index('detailed_id', 'detailed_id');
            $table->index('image_id', 'image_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images_links');
    }
};
