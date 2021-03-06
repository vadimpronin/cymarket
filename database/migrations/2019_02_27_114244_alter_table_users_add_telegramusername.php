<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsersAddTelegramusername extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('telegram_username')->nullable()->after('email');
            $table->unsignedBigInteger('telegram_id')->nullable()->unique()->after('telegram_username');
            $table->string('current_scenario')->nullable()->after('telegram_id');
            $table->string('current_step')->nullable()->after('current_scenario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telegram_username');
            $table->dropColumn('telegram_id');
            $table->dropColumn('current_scenario');
            $table->dropColumn('current_step');
            $table->string('name')->change();
            $table->string('email')->change();
        });
    }
}
