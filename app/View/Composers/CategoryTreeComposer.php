<?php

namespace App\View\Composers;

use App\Services\CategoryService;
use Illuminate\View\View;

class CategoryTreeComposer
{
    protected CategoryService $categoryService;

    // 使用 Laravel 的依赖注入，自动注入所需要的 CategoryService 类
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // 当渲染指定的模版时，Laravel 会调用 compose 方法
    public function compose(View $view): void
    {
        // 使用 with 方法注入变量
        $view->with('categoryTree', $this->categoryService->getCategoryTree());
    }
}
