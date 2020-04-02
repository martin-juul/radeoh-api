<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->text('title');
            $table->text('country_code');
            $table->text('language');
            $table->text('slug');
            $table->text('guide_id');
            $table->text('m3u_url')->nullable();
            $table->text('image')->nullable();


            $table->timestampsTz();
        });
        set_uuid_generate('stations');
        alter_column('stations', 'title', 'citext');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stations');
    }
}
