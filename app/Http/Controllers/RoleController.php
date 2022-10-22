<?php

namespace App\Http\Controllers;

use App\Role;
use App\RolePermission;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response as HttpResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view', ['roles']);
        $role = Role::all();
        return RoleResource::collection($role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('edit', ['roles']);
        $role =  Role::create([
            'name' => $request->name
        ]);

        if ($permissions = $request->permissions) {
            foreach ($permissions as $value) {
                RolePermission::create([
                    'role_id'   => $role->id,
                    'permission_id' => $value
                ]);
            }
        }

        return response(new RoleResource($role), HttpResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('view', ['roles']);
        return new RoleResource(Role::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('edit', ['roles']);
        Gate::authorize('view', ['roles']);
        $role = Role::find($id);

        $role->update([
            'name' => $request->name
        ]);

        RolePermission::where('role_id', $role->id)->delete();

        if ($permissions = $request->permissions) {
            foreach ($permissions as $value) {
                RolePermission::create([
                    'role_id'   => $role->id,
                    'permission_id' => $value
                ]);
            }
        }

        return response(new RoleResource($role), HttpResponse::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('edit', ['roles']);
        RolePermission::where('role_id', $id)->delete();
        Role::destroy($id);
        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
