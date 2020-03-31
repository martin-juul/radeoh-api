<?php

use Illuminate\Database\Migrations\Migration;

class AddUuidExtensionToPostgresql extends Migration
{
    public function up()
    {
        pg_create_extension('uuid-ossp');
    }

    public function down()
    {
        pg_drop_extension('uuid-ossp');
    }
}
