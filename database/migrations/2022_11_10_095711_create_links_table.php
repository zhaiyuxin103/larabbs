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
    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id()->comment('自增长 ID');
            $table->string('title')->index()->comment('标题');
            $table->string('description')->nullable()->comment('描述');
            $table->string('link')->index()->comment('链接');
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
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
