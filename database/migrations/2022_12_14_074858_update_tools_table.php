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
        Schema::table('images_links', function (Blueprint $table) {
            $table->dropIndex('object_id');
            $table->foreign('object_id')->references('id')->on('tools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images_links', function (Blueprint $table) {
            $table->dropForeign('images_links_object_id_foreign');
        });
    }
};
