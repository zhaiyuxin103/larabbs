<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use App\Services\CategoryService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function uploadImage(Request $request, ImageUploadHandler $uploader): array
    {
        //  初始化返回数据，默认是失败的
        $data = ['location' => null];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->file('upload_file')) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['location'] = config('app.url').$result['path'];
            }
        }

        return $data;
    }

    public function store(TopicRequest $request, Topic $topic, ImageUploadHandler $uploader): Redirector|RedirectResponse
    {
        $topic->fill(array_merge($request->all(), [
            'image' => Arr::get($uploader->save($request->file('image'), 'topics', Auth::id(), 1024), 'path'),
        ]));
        $topic->user_id = Auth::id();
        $topic->save();

        return Redirect::route('topics.show', $topic->id)->with('flash.banner', '话题创建成功！');
    }

    public function show(Topic $topic): Response
    {
        return Inertia::render('Topics/Show', [
            'categories' => Category::where('show', true)->orderBy('order')->get(),
            'topic' => Topic::with(['user', 'category.parent'])->find($topic->id),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Topic $topic, TopicRequest $request): Response
    {
        $this->authorize('update', $topic);

        return Inertia::render('Topics/Edit', [
            'topic' => Topic::with(['category.parent'])->find($topic->id),
            'categories' => Category::where('show', true)->orderBy('order')->get(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(TopicRequest $request, Topic $topic): Redirector|RedirectResponse
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());

        return Redirect::route('topics.show', $topic->id)->with('flash.banner', '话题更新成功！');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Topic $topic): Redirector|RedirectResponse
    {
        $this->authorize('delete', $topic);
        $topic->delete();

        return Redirect::route('topics.index')->with('flash.banner', '话题删除成功！');
    }
}
