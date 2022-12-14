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
        if (Schema::hasTable('tools')) {
            Schema::dropIfExists('tools');
        }

        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('tool_code', 64)->charset('utf8mb3')->collation('utf8mb3_general_ci')->default('');
            $table->string('tool_type', 24)->charset('utf8mb3')->collation('utf8mb3_general_ci')->default('tool');
            $table->char('status', 1)->charset('utf8mb3')->collation('utf8mb3_general_ci')->default('A');
            $table->mediumInteger('amount')->default(0);
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
        Schema::dropIfExists('tools');
    }
};
