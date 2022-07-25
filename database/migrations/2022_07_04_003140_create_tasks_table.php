<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('folder_id')->unsigned();
            $table->string('title', 100);
            $table->integer('status')->default(1);
            $table->timestamps();

            // 外部キーを設定する
            $table->foreign('folder_id')->references('id')->on('folders');

            // 削除
            $table->softDeletes();

            // $table->complete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');

        // 削除
        Schema::table('texts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}