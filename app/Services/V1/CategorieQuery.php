<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CategorieQuery 
{
    protected $allowedParams = [
        'id_categorie' => ['equals', 'lowerThan', 'lowerThanEquals', 'greaterThan', 'greaterThanEquals'],
        'nom' => ['equals']
    ];

    protected $columnMap = [
        'idCategorie' => 'id_categorie',
        'nomCategorie' => 'nom_categorie'
    ];

    protected $operatorMap = [
        'equals' => '=',
        'lowerThan' => '<',
        'lowerThanEquals' => '<=',
        'greaterThan' => '>',
        'greaterThanEquals' => '>=',
    ];

    public function transform(Request $request) {
        $eloquentQuery = [];

        foreach($this->allowedParams as $param => $operators) {
            $query = $request->query($param);

            if(!isset($query))
                continue;
            
            $column = $this->columnMap[$param] ?? $param;

            foreach($operators as $operator) {
                if(isset($query[$operator])) {
                    $eloquentQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloquentQuery;
    }
}