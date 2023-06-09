### `/marquePages`

#### GET

This endpoint is used to get all bookmarks. It accepts a GET request with optional query parameters.

| Parameter                   | Type      | Required | Description                                                                                                                    |
| --------------------------- | --------- | -------- | ------------------------------------------------------------------------------------------------------------------------------ |
| `perPage`                   | `integer` | `false`  | Set the number of categories per page.                                                                                         |
| `<key>[<operator>]=<value>` | `string`  | `false`  | Filter comments with operators like `equals`, `notEquals`, `lowerThan`, `lowerThanEquals`, `greaterThan`, `greaterThanEquals`. |



#### POST

This endpoint is used to create a new bookmarks. It accepts a POST request with a JSON payload containing the bookmark's information.

**Example request:**
```http
POST /api/v1/marquePages HTTP/1.1
Content-Type: application/json
Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg

{
  "idUtilisateur": 1,
  "idRessource": 2
}
```

**Example response:**
```http
HTTP/1.1 201 Created
Content-Type: application/json
{
  "id": 10,
  "idUtilisateur": 1,
  "idRessource": 2
}
```

### `/marquePages/{id}`

#### GET

This endpoint is used to get a bookmark by its id. It accepts a GET request with the favorite's id as a path parameter.


| Parameter | Type      | Required | Description             |
| --------- | --------- | -------- | ----------------------- |
| `id`      | `integer` | `true`   | The id of the bookmark. |

**Example request:**
```http
GET /api/v1/marquePages/1 HTTP/1.1
Accept: application/json
Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 1,
  "idUtilisateur": 1,
  "idRessource": 2
}
```

<br>

#### DELETE

This endpoint is used to delete a bookmark. It accepts a DELETE request with the bookmark's id as a path parameter.

| Parameter | Type      | Required | Description             |
| --------- | --------- | -------- | ----------------------- |
| `id`      | `integer` | `true`   | The id of the bookmark. |


**Example request:**
```http
DELETE /api/v1/marquePages/1 HTTP/1.1
Accept: application/json
Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```