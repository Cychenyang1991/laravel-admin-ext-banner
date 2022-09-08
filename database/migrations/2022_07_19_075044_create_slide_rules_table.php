<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlideRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',30)->comment('组件类型');
            $table->tinyInteger('type')->comment('组件运行方式 1手动 2自动');
            $table->integer('time')->nullable()->comment('自动运行的时间间隔');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide_rules');
    }
};
