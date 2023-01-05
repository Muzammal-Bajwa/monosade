<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFaviconToWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces', function (Blueprint $table) {
           $table->string('favicon')->nullable()->after('logo');
        });
    }

    public function down()
    {
        Schema::table('workspaces', function (Blueprint $table) {
            //
        });
    }
}
