<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Jiannei\Response\Laravel\Support\Facades\Response;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse|JsonResource
     */
    public function index(Request $request): JsonResponse|JsonResource
    {
        $permissions = $request->user()->getAllPermissions();

        return Response::success(PermissionResource::collection($permissions));
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
