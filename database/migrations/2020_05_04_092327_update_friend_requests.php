<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFriendRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('friends', function (Blueprint $table) {
            $table->renameColumn('user_id_1', 'user_1_id');
            $table->renameColumn('user_id_2', 'user_2_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('friends', function (Blueprint $table) {
            $table->renameColumn('user_1_id', 'user_id_1');
            $table->renameColumn('user_2_id', 'user_id_2');
        });
    }
}
