<?php

use Illuminate\Database\Migrations\Migration;

class AddCitextExtensionToPostgresql extends Migration
{
    public function up()
    {
        pg_create_extension('citext');
    }

    public function down()
    {
        pg_drop_extension('citext');
    }
}
