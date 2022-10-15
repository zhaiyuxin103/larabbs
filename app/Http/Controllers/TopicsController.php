<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

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
        $categories = Category::where('show', true)->orderBy('order')->get();
        $previous = url()->previous();

        return Inertia::render('Topics/Create', compact('categories', 'previous'));
    }

    public function show(Topic $topic): Response
    {
        return Inertia::render('Topics/Show', [
            'topic' => $topic,
        ]);
    }

    public function store(TopicRequest $request, Topic $topic, ImageUploadHandler $uploader): Redirector|RedirectResponse
    {
        $topic->fill(array_merge($request->all(), [
            'image' => Arr::get($uploader->save($request->file('image'), 'topics', Auth::id(), 1024), 'path'),
        ]));
        $topic->user_id = Auth::id();
        $topic->save();

        return Redirect::route('topics.show', $topic->id)->with('success', '帖子创建成功！');
    }

    public function edit(): Response
    {
        return Inertia::render('Topics/Edit');
    }
}
