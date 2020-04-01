<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->text('email')->index();
            $table->foreign('email')
                ->references('email')->on('users')
                ->deferrable()
                ->cascadeOnDelete();

            $table->text('token');
            $table->timestampTz('created_at')->nullable();
        });
        set_uuid_generate('password_resets');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
