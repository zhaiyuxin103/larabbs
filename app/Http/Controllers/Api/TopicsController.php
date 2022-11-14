<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Image;
use App\Models\Topic;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Jiannei\Response\Laravel\Support\Facades\Response;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TopicRequest  $request
     * @param  Topic  $topic
     * @return JsonResponse
     */
    public function store(TopicRequest $request, Topic $topic): JsonResponse
    {
        $topic->fill($request->all(['title', 'subtitle', 'body', 'category_id', 'is_released', 'need_released', 'released_at']));
        $request->whenFilled('topic_image_id', function ($input) use ($topic) {
            $image = Image::find($input);

            $topic->image = $image->path;
        });
        $topic->user_id = $request->user()->id;
        $topic->order = $request->filled('order') ? $request->input('order') : 0;
        $topic->save();

        return Response::success(new TopicResource($topic));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TopicRequest  $request
     * @param  Topic  $topic
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function update(TopicRequest $request, Topic $topic): JsonResponse
    {
        $this->authorize('update', $topic);
        $attributes = $request->all(['title', 'subtitle', 'body', 'category_id', 'is_released', 'need_released', 'released_at', 'order']);
        $request->whenFilled('topic_image_id', function ($input) use (&$attributes) {
            $image = Image::find($input);

            $attributes['image'] = $image->path;
        });
        $topic->update($attributes);

        return Response::success(new TopicResource($topic));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Topic  $topic
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function destroy(Topic $topic): JsonResponse
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        return Response::noContent();
    }
}
