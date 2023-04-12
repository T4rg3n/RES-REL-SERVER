# Operations

The RESREL API support multiple optionnal operations primarly in the form of query parameters. You can combine multiple operations in a single request like this:

```
<api url>/api/v1/<endpoint>?<query parameter>=<value>&<other-query-paremeter>=<other-value>
```

Not all endpoints support all operations. The details are kept in [the documentation of each endpoint](/enpoints/#list-of-endpoints).

## Pagination

All results are paginated by default. You can specify the page number and the number of results per page using the `page` and `perPage` query parameters. The default page number is 1 and the default number of results per page is 15. 

```md
?page=2&perPage=30
```

There isn't a maximum number of results per page, however I would recommend not going over 100 as results can get quite large.

## Sorting

You can sort the results of a request by using the `sortBy` query parameter. This query parameter takes a field of the endpoint you want to sort on, separated by a comma for the type of ordering. If you dont specify any `sortBy`, the default sort type is ascending.

```
?sortBy=nom,desc
```

## Filtering

You can filter the results of a request by using the `<key>[<operator>]=<value>` query parameter. This query parameter takes a field of the endpoint you want to filter on, an operator as well as the value you want to filter. The following operators are available:

   - `equals` =
   - `notEquals` !=
   - `lowerThan` <
   - `lowerThanEquals` <=
   - `greaterThan` >
   - `greaterThanEquals` >=

In practice, this would look like this to filter all users with the name John:

```
?nom[equals]=John
```

## Aggregating

Sometimes it's useful to include related data in a request. For example, you might want to get a list of ressources, their authors, as well as the categories of those ressources in a single request. You can do this by using the `include` query parameter. This query parameter takes a comma separated list of fields you want to include in the response.

```
/ressources?include=utilisateurs,categories
```

<br>
