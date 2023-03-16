<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\V1\SearchRequest;
use App\Http\Controllers\Controller;
use App\Models\Ressource;

class SearchController extends Controller
{
    //search on ressources and users
    //Search is a POST request
    public function search(SearchRequest $request)
    {
        //search for a specific ressource or user
    }
}
