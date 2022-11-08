<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id()->comment('自增长 ID');
            $table->unsignedBigInteger('topic_id')->index()->comment('话题 ID');
            $table->unsignedBigInteger('user_id')->index()->comment('用户 ID');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('父级回复 ID');
            $table->text('content')->comment('内容');
            $table->boolean('show')->default(true)->comment('是否显示');
            $table->integer('order')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
