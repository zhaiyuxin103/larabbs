<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Jiannei\Response\Laravel\Support\Facades\Response;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse|JsonResource
     */
    public function index(Request $request): JsonResponse|JsonResource
    {
        $notifications = $request->user()->notifications()->paginate();

        return Response::success(NotificationResource::collection($notifications));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse|JsonResource
     */
    public function stats(Request $request): JsonResponse|JsonResource
    {
        return Response::success([
            'unread_count' => $request->user()->notification_count,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse|JsonResource
     */
    public function store(Request $request): JsonResponse|JsonResource
    {
        //
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
     * @param Request $request
     * @return mixed
     */
    public function read(Request $request): mixed
    {
        $request->user()->markAsRead();

        return Response::noContent();
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
     * @param  int  $id
     * @return JsonResponse|JsonResource
     */
    public function destroy(int $id): JsonResponse|JsonResource
    {
        //
    }
}
