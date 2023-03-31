<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoteController extends Controller
{
    /**
     * Edit the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function patch(Request $request)
    {
        $this->validate($request, [
            'idUtilisateur' => 'required|integer',
            'idRole' => 'required|integer',
        ]);
    }
}
