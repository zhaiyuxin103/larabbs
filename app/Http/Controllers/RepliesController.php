<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

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

    public function userIndex(User $user): \Inertia\Response
    {
        return Inertia::render('Users/Replies', [
            'replies' => Reply::where('user_id', $user->id)->with(['topic'])->paginate(),
            'page' => Request()->input('page', 1),
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
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
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
     * @return Response
     */
    public function destroy(Reply $reply): Response
    {
        //
    }
}
