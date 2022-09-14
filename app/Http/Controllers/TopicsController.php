<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\User;
use App\Services\CategoryService;
use Inertia\Inertia;
use Inertia\Response;

class TopicsController extends Controller
{
    public function index(CategoryService $categoryService): Response
    {
        return Inertia::render('Topics/Index', [
            // 将类目树传递给模版文件
            'categoryTree' => $categoryService->getCategoryTree(),
            'topics' => Topic::with(['category', 'user'])->withOrder(Request()->input('order'))->paginate(),
            'page' => Request()->input('page', 1),
        ]);
    }

    public function userIndex(User $user, CategoryService $categoryService): Response
    {
        return Inertia::render('Users/Topics', [
            // 将类目树传递给模版文件
            'categoryTree' => $categoryService->getCategoryTree(),
            'topics' => Topic::where('user_id', $user->id)->with(['category', 'user'])->withOrder(Request()->input('order'))->paginate(),
            'page' => Request()->input('page', 1),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Topics/Create');
    }

    public function show(Topic $topic): Response
    {
        return Inertia::render('Topics/Show', [
            'topic' => $topic,
        ]);
    }

    public function edit(): Response
    {
        return Inertia::render('Topics/Edit');
    }
}
