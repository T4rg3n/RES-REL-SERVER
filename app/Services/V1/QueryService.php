<?php

namespace App\Services\V1;

class QueryService
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
                        if (!isset($eloquentQuery[$columnName])) {
                            $eloquentQuery[$columnName] = [];
                        }
                        $values = explode(',', $value);
                        $eloquentQuery[$columnName][$comparisonOperator] = $values;
                    } else {
                        return abort(400, "Operator '{$operator}' not allowed for parameter '{$param}'");
                    }
                }
            } else {
                if ($param == 'page' || 'perPage') {
                    continue;
                }

                return abort(400, "Parameter '{$param}' not allowed\n");
            }
        }

        return $eloquentQuery;
    }

    /**
     * Translates orderBy fields to database columns with columnMap
     *
     * @param string $orderByField
     * @param string $defaultColumn
     * @param array $columnMap
     * @return array
     */
    public function translateOrderBy(?string $orderByField, string $defaultColumn, array $columnMap): array
    {
        $orderByColumn = $defaultColumn;
        $orderByType = 'asc';

        if (!empty($orderByField)) {
            $orderByArray = explode(',', $orderByField);

            if (count($orderByArray) != 2) {
                abort(400, 'Invalid orderBy, too little/many parameters');
            } else {
                $orderByColumn = $orderByArray[0];
                $orderByType = $orderByArray[1];

                if (isset($columnMap[$orderByColumn])) {
                    $orderByColumn = $columnMap[$orderByColumn];
                }

                if (!in_array($orderByColumn, $columnMap) || !in_array($orderByType, ['asc', 'desc'])) {
                    abort(400, 'Invalid orderBy');
                }
            }
        }

        return [$orderByColumn, $orderByType];
    }

    /**
     * Includes related data in query
     *
     * @param request $request
     * @param  $allowedIncludes
     * @return array
     */
    public function include($request, $allowedIncludes)
    {
        $includes = $request->query('include');
        $includedArray = [];

        if ($includes) {
            $includedArray = explode(',', $includes);
            //return $includedArray;
            foreach ($includedArray as $include) {
                if (!in_array($include, $allowedIncludes)) {
                    return abort(400, 'Invalid include parameter');
                }
            }
        }

        return $includedArray;
    }
}
