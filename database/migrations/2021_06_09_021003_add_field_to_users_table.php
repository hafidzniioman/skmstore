<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //menambahkan entitas username, phonenumber, roles di tabel user pada ERD ke database
            $table->string('roles')->after('email')->default('USER');
            $table->string('phone')->after('email')->nullable();
            $table->string('username')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * fungsi ini sama seperti menghapus data (entitas) pada database
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //menghapus entitas yang dilakukan oleh user
            //mengembalikan entitas username, phonenumber, dan roles
            $table->dropColumn('roles');
            $table->dropColumn('phone');
            $table->dropColumn('username');
        });
    }
}
