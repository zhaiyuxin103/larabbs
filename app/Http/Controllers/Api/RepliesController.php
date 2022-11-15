<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use App\Models\Topic;
use App\Queries\ReplyQuery;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Jiannei\Response\Laravel\Support\Facades\Response;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @param  ReplyQuery  $query
     * @return JsonResponse|JsonResource
     */
    public function index(int $id, ReplyQuery $query): JsonResponse|JsonResource
    {
        $replies = $query->where('topic_id', $id)->whereNull('parent_id')->paginate();

        return Response::success(ReplyResource::collection($replies));
    }

    /**
     * @param  int  $id
     * @param  ReplyQuery  $query
     * @return JsonResponse|JsonResource
     */
    public function userIndex(int $id, ReplyQuery $query): JsonResponse|JsonResource
    {
        $replies = $query->where('user_id', $id)->paginate();

        return Response::success(ReplyResource::collection($replies));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReplyRequest  $request
     * @param  Topic  $topic
     * @param  Reply  $reply
     * @return JsonResponse|JsonResource
     */
    public function store(ReplyRequest $request, Topic $topic, Reply $reply): JsonResponse|JsonResource
    {
        $reply->topic()->associate($topic);
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->input('parent_id');
        $reply->content = $request->input('content');
        $reply->save();

        return Response::success(new ReplyResource($reply))->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse|JsonResource
     */
    public function show(int $id): JsonResponse|JsonResource
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse|JsonResource
     */
    public function update(Request $request, int $id): JsonResponse|JsonResource
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Topic  $topic
     * @param  Reply  $reply
     * @return JsonResponse|JsonResource
     *
     * @throws AuthorizationException
     */
    public function destroy(Topic $topic, Reply $reply): JsonResponse|JsonResource
    {
        if ($reply->topic_id !== $topic->id) {
            Response::errorNotFound();
        }

        $this->authorize('delete', $reply);
        $reply->delete();

        return Response::noContent();
    }
}
