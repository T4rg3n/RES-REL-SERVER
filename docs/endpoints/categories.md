### `/categories`

#### GET 

This endpoint is used to get a list of all categories. It accepts a GET request with optional query parameters.

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `perPage`                        |`integer`| `false`  | Set the number of categories per page.                                                   |
| `<key>[<operator>]=<value>`      |`string` | `false`  | Filter categories with operators like `equals`, `notEquals`, `lowerThan`, `lowerThanEquals`, `greaterThan`, `greaterThanEquals`. |


**Example request:**
```http
GET /api/v1/categories HTTP/1.1
Host: api.victor-gombert.fr
Accept: application/json
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

[
  {
    "id": 1,
    "nom": "Communication"
  },
  {
    "id": 2,
    "nom": "Culture"
  }
]
```
#### POST

You can create a new category by sending a POST request with a JSON payload :

**Example request :**
```http
POST /connexion HTTP/1.1
Content-Type: application/json

{
  "nom": "Ma super categorie"
}
```

**Example response:**
```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "id": 14,
  "nom": "Ma super categorie"
}
```

### `/categories/{id}`

#### GET

This endpoint is used to get a category by its id. It accepts a GET request with the category's id as a path parameter.

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `id`                             |`integer`| `true`   | The id of the category.                                                                  |

**Example request:**
```http
GET /api/v1/categories/1 HTTP/1.1
Accept: application/json
```

*** Example response:***
```http
HTTP/1.1 200 OK
Content-Type: application/json
{
  "id": 1,
  "nom": "Communication"
}
```

#### DELETE

This endpoint is used to delete a category by its id. It accepts a DELETE request with the category's id as a path parameter.

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `id`                             |`integer`| `true`   | The id of the category.                                                                  |

**Example request:**
```http
DELETE /categories/1 HTTP/1.1
Accept: application/json
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Categorie deleted"
}
```
