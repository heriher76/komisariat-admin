<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailToArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->string('thumbnail')->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('thumbnail')->nullable();
        });

        Schema::table('ebooks', function (Blueprint $table) {
            $table->string('thumbnail')->nullable();
        });

        Schema::table('info_training', function (Blueprint $table) {
            $table->string('thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });

        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });

        Schema::table('info_training', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });
    }
}
