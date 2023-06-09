<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreBookmarkRequest;
use App\Models\Bookmark;
use App\Services\V1\QueryService;
use App\Http\Resources\V1\BookmarkCollection;
use App\Http\Resources\V1\BookmarkResource;

class BookmarkController extends Controller
{
    /**
     * Allowed parameters for filtering
    */
    protected $allowedParams = [
        'id' => ['equals'],
        'dateSauvegarde' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'idUtilisateur' => ['equals'],
        'idRessource' => ['equals'],
    ];

    /**
     * Translate request parameters to database columns for filtering
    */
    protected $columnMap = [
        'id' => 'id_bookmark',
        'dateSauvegarde' => 'date_bookmark',
        'idUtilisateur' => 'fk_id_uti',
        'idRessource' => 'fk_id_ressource',
    ];

    /**
     * Allowed includes
    */
    protected $allowedIncludes = [
        'utilisateur',
        'ressource'
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
        $bookmarks = Bookmark::where($eloquentQuery);

        // Order by
        [$fieldOrder, $typeOrder] = (new QueryService())->translateOrderBy($request->query('orderBy'), 'id_bookmark', $this->columnMap);
        $bookmarks = Bookmark::where($eloquentQuery)->orderBy($fieldOrder, $typeOrder);

        // Include
        $include = (new QueryService())->include(request(), $this->allowedIncludes);
        if ($include) {
            $bookmarks->with($include);
        }

        return new BookmarkCollection($bookmarks->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookmarkRequest $request)
    {
        $bookmark = Bookmark::create($request->all());
        $bookmark->save();
        $id = $bookmark->id_bookmark;

        return response()->json($this->show($id), 201);
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id_bookmark
     * @return \Illuminate\Http\Response
     */
    public function show($id_bookmark)
    {
        $bookmark = Bookmark::findOrFail($id_bookmark);

        $include = (new QueryService())->include(request(), $this->allowedIncludes);
        if ($include) {
            $bookmark->loadMissing($include);
        }
        
        return new BookmarkResource($bookmark);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_bookmark)
    {
        $bookmark = Bookmark::findOrFail($id_bookmark);
        $bookmark->delete();

        return response()->json([
            'message' => 'Bookmark deleted'
        ], 200);
    }
}
