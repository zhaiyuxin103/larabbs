<?php

namespace App\Http\Controllers\Api;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jiannei\Response\Laravel\Support\Facades\Response;

class ImagesController extends Controller
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
     * @param  ImageRequest  $request
     * @param  ImageUploadHandler  $uploader
     * @param  Image  $image
     * @return JsonResponse
     */
    public function store(ImageRequest $request, ImageUploadHandler $uploader, Image $image): JsonResponse
    {
        $user = $request->user();

        $size = $request->input('type') === 'avatar' ? 416 : 1024;
        $result = $uploader->save($request->file('image'), Str::plural($request->input('type')), $size);

        $image->user_id = $user->id;
        $image->path = Storage::url($result['path']);
        $image->type = $request->input('type');
        $image->save();

        return Response::success(new ImageResource($image));
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
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        //
    }
}
