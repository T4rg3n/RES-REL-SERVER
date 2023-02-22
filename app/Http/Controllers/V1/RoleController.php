<?php

namespace App\Http\Controllers\V1;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RoleResource;
use App\Http\Resources\V1\RoleCollection;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RoleCollection(Role::paginate());
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id_role
     * @return \Illuminate\Http\Response
     */
    public function show($id_role)
    {
        $role = Role::where('id_role', $id_role)->first();

        return new RoleResource($role);
    }
}
