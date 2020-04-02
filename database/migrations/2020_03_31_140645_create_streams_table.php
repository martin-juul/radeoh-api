<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('station_id');
            $table->foreign('station_id')
                ->references('id')->on('stations')
                ->deferrable()
                ->cascadeOnDelete();

            $table->text('stream_url');

            $table->timestampsTz();
        });
        set_uuid_generate('streams');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streams');
    }
}
