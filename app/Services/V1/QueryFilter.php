<?php

namespace App\Services\V1;

class QueryFilter
{
    /**
     * Allowed operators for filtering
     */
    protected $operatorMap = [
        'equals' => '=',
        'notEquals' => '!=',
        'lowerThan' => '<',
        'lowerThanEquals' => '<=',
        'greaterThan' => '>',
        'greaterThanEquals' => '>=',
    ];

    /**
     * Transform request parameters to Eloquent query
     *
     * @param $request
     * @param $allowedParams
     * @return array
     */
    public function transform($request, $allowedParams, $columnMap)
    {
        $eloquentQuery = [];
        
        foreach ($request as $param => $operators) {
            if (isset($allowedParams[$param])) {
                foreach ($operators as $operator => $value) {
                    if (in_array($operator, $allowedParams[$param])) {
                        $columnName = $columnMap[$param];
                        $comparisonOperator = $this->operatorMap[$operator];
                        $eloquentQuery[] = [$columnName, $comparisonOperator, $value];             
                    } else {
                        return abort(400, "Operator '{$operator}' not allowed for parameter '{$param}'");
                    }
                }
            } else {
                if($param == 'page') {
                    continue;
                }
                
                return abort(400, "Parameter '{$param}' not allowed\n");
            }
        }

        return $eloquentQuery;
    }
}
