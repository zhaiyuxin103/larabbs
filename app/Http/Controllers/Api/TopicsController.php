<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Image;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|JsonResource
     */
    public function index(): JsonResponse|JsonResource
    {
        $topics = QueryBuilder::for(Topic::class)
           ->allowedIncludes(['user', 'category'])
           ->allowedFilters([
               'title',
               AllowedFilter::exact('category_id'),
               AllowedFilter::scope('withOrder')->default('recentReplied'),
           ])
           ->paginate();

        return Response::success(TopicResource::collection($topics));
    }

    public function userIndex(Request $request, User $user): JsonResponse|JsonResource
    {
        $query = $user->topics()->getQuery();

        $topics = QueryBuilder::for($query)
            ->allowedIncludes(['user', 'category'])
            ->allowedFilters([
                'title',
                AllowedFilter::exact('category_id'),
                AllowedFilter::scope('withOrder')->default('recentReplies'),
            ])
            ->paginate();

        return Response::success(TopicResource::collection($topics));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TopicRequest  $request
     * @param  Topic  $topic
     * @return JsonResponse|JsonResource
     */
    public function store(TopicRequest $request, Topic $topic): JsonResponse|JsonResource
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
     * @return JsonResponse|JsonResource
     */
    public function show(int $id): JsonResponse|JsonResource
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TopicRequest  $request
     * @param  Topic  $topic
     * @return JsonResponse|JsonResource
     *
     * @throws AuthorizationException
     */
    public function update(TopicRequest $request, Topic $topic): JsonResponse|JsonResource
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
     * @return JsonResponse|JsonResource
     *
     * @throws AuthorizationException
     */
    public function destroy(Topic $topic): JsonResponse|JsonResource
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        return Response::noContent();
    }
}
