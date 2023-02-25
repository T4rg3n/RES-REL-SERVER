<?php

namespace App\Http\Controllers\V1;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RoleResource;
use App\Http\Resources\V1\RoleCollection;
use App\Services\V1\QueryFilter;

class RoleController extends Controller
{
    /**
     * Allowed parameters for filtering
     */
    protected $allowedParams = [
        'nom' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
     */
    protected $columnMap = [
        'nom' => 'nom_role',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $roles = Role::where($eloquentQuery)->paginate();

        return new RoleCollection($roles->appends($request->query()));
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
