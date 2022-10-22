<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\user\UserUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view', ['users']);
        $user = User::paginate();
        return response(UserResource::collection($user), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        Gate::authorize('edit', ['users']);
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        Gate::authorize('edit', ['users']);
        $user = User::find($id);
        return response(new UserResource($user), 200);

        // $user = User::with('role')->find($id);
        // return response($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        Gate::authorize('edit', ['users']);
        $user = User::find($id);
        $request['password'] = Hash::make($request->password);
        $user->update($request->all());
        return response(new UserResource($user), 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('edit', ['users']);
        User::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function profile()
    {
        $data = Auth::user();
        return (new UserResource($data))->additional([
            'permission' => $data->permissions()
        ]);
    }

    public function updateProfile(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }
}
