<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLgpDictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lgp_dict', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('select');
            $table->timestamps();
        });
        Schema::create('lgp_dict_option', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('json')->nullable();
            $table->integer('dict_id')->references('id')->on('lgp_dict');
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
        Schema::dropIfExists('lgp_dict');
        Schema::dropIfExists('lgp_dict_option');
    }
}
