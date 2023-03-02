<?php

namespace App\Http\Controllers\V1;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RoleResource;
use App\Http\Resources\V1\RoleCollection;
use App\Http\Requests\V1\StoreRoleRequest;
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
        $perPage = request()->input('perPage', 15);
        $queryContent = $request->all();
        $filter = new QueryFilter();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $roles = Role::where($eloquentQuery)->paginate($perPage);

        return new RoleCollection($roles->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->save();
        $id = $role->id;

        return response()->json($this->show($id), 201);
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
