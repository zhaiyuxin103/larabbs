<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    // 监听 Category 的创建事件，用于初始化 path 和 level 字段值
    public function creating(Category $category): void
    {
        // 如果创建的是一个根目录
        if (is_null($category->parent_id)) {
            // 将层级设为 0
            $category->level = 0;
            // 将 path 设为 -
            $category->path = '-';
        } else {
            // 将层级设为父类目的层级 + 1
            $category->level = $category->parent->level + 1;
            // 将 path 值设为父类目的 path 追加父类目 ID 以及最后跟上一个 - 分隔符
            $category->path = $category->parent->path.$category->parent_id.'-';
        }
    }

    /**
     * Handle the Category "created" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
