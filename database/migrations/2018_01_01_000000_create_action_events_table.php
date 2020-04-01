<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('batch_id');

            $table->uuid('user_id')->index();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->deferrable()
                ->cascadeOnDelete();

            $table->text('name');
            $table->text('actionable_type');
            $table->uuid('actionable_id');

            $table->text('target_type');
            $table->uuid('target_id');

            $table->text('model_type');
            $table->uuid('model_id')->nullable();

            $table->text('fields');

            $table->text('status')->default('running');

            $table->jsonb('exception');

            $table->timestampsTz();

            $table->index(['actionable_type', 'actionable_id']);
            $table->index(['batch_id', 'model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_events');
    }
}
