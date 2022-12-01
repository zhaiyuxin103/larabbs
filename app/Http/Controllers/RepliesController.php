<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        //
    }

    public function userIndex(User $user): Response
    {
        return Inertia::render('Users/Replies', [
            'replies' => Reply::where('user_id', $user->id)->with(['topic'])->paginate(),
            'page' => (int) Request()->input('page', 1),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReplyRequest  $request
     * @param  Reply  $reply
     * @return Redirector|RedirectResponse
     */
    public function store(ReplyRequest $request, Reply $reply): Redirector|RedirectResponse
    {
        $topic = Topic::find($request->input('topic_id'));
        $reply->topic_id = $topic->id;
        $reply->user_id = Auth::id();
        $reply->parent_id = $request->input('parent_id');
        $reply->content = $request->input('content');
        $reply->save();

        return Redirect::route('topics.show', [$topic->hash_id, $topic->slug])->with('flash.banner', '评论创建成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  Reply  $reply
     * @return Response
     */
    public function show(Reply $reply): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reply  $reply
     * @return Response
     */
    public function edit(Reply $reply): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Reply  $reply
     * @return Response
     */
    public function update(Request $request, Reply $reply): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reply  $reply
     * @return Redirector|RedirectResponse
     *
     * @throws AuthorizationException
     */
    public function destroy(Reply $reply): Redirector|RedirectResponse
    {
        $this->authorize('delete', $reply);
        $reply->delete();

        return Redirect::route('topics.show', [$reply->topic->hash_id, $reply->topic->slug])->with('flash.banner', '评论删除成功！');
    }
}
