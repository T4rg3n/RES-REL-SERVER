<?php

namespace App\Http\Controllers\V1;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RoleResource;
use App\Http\Resources\V1\RoleCollection;
use App\Http\Requests\V1\StoreRoleRequest;
use App\Services\V1\QueryService;

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
        $filter = new QueryService();
        $eloquentQuery = $filter->transform($queryContent, $this->allowedParams, $this->columnMap);
        $roles = Role::where($eloquentQuery);

        return new RoleCollection($roles->paginate($perPage)->appends($request->query()));
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
        $id = $role->id_role;

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
        $role = Role::findOrfail($id_role);

        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_role)
    {
        $role = Role::findOrfail($id_role);
        $role->delete();

        return response()->json([
            'message' => 'Role deleted'
        ], 200);
    }
}
