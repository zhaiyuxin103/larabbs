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
        Schema::create('topics', function (Blueprint $table) {
            $table->id()->comment('自增长 ID');
            $table->string('title')->index()->comment('帖子标题');
            $table->string('subtitle')->comment('副标题');
            $table->string('image')->nullable()->comment('图片');
            $table->text('body')->comment('帖子内容');
            $table->unsignedBigInteger('user_id')->index()->comment('用户 ID');
            $table->unsignedBigInteger('category_id')->index()->comment('分类 ID');
            $table->boolean('is_released')->default(0)->comment('是否已发布');
            $table->boolean('need_released')->default(0)->comment('是否需要自动发布');
            $table->dateTime('released_at')->nullable()->comment('发布时间');
            $table->unsignedInteger('vote_count')->default(0)->comment('点赞数量');
            $table->unsignedInteger('collect_count')->default(0)->comment('收藏数量');
            $table->unsignedInteger('reply_count')->index()->default(0)->comment('回复数量');
            $table->unsignedInteger('view_count')->index()->default(0)->comment('查看总数');
            $table->unsignedBigInteger('last_reply_user_id')->index()->default(0)->comment('最后回复的用户 ID');
            $table->text('excerpt')->nullable()->comment('文章摘要，SEO 优化时使用');
            $table->string('slug')->nullable()->comment('SEO 友好的 URL');
            $table->unsignedInteger('order')->default(0)->comment('排序');
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
        Schema::dropIfExists('topics');
    }
};
