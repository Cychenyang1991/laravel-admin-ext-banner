<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_slides', function (Blueprint $table) {
            $table->id();
            $table->string('url')->comment('素材地址');
            $table->unsignedTinyInteger('url_type')->comment('素材类型');
            $table->string('name',60)->nullable()->comment('名称');
            $table->enum('slide_type',['none','official','outside_mini','inside_mini'])->comment('交互类型none无，official公众号，outside_mini外部小程序，inside_mini内部小程序');
            $table->json('slide_type_content')->comment('交互内容');
            $table->unsignedTinyInteger('status')->comment('状态 1开启 2关闭');
            $table->unsignedTinyInteger('sort')->comment('排序');
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
        Schema::dropIfExists('slides');
    }
}
