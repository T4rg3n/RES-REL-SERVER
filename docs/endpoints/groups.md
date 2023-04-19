### `/groupes`

#### GET

This endpoint is used to get all groups. It accepts a GET request.

| Parameter                   | Type      | Required | Description                                                                                                                    |
| --------------------------- | --------- | -------- | ------------------------------------------------------------------------------------------------------------------------------ |
| `perPage`                   | `integer` | `false`  | Set the number of categories per page.                                                                                         |
| `<key>[<operator>]=<value>` | `string`  | `false`  | Filter comments with operators like `equals`, `notEquals`, `lowerThan`, `lowerThanEquals`, `greaterThan`, `greaterThanEquals`. |

**Example request:**

```http
GET /api/v1/groupes HTTP/1.1
Content-Type: application/json
Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
"data": [
    {
      "id": 1,
      "nom": "Groupe 1",
      "description": "Description du groupe 1",
      "estPrive": true
    },
    {
      "id": 2,
      "nom": "Groupe 2",
      "description": "Description du groupe 2",
      "estPrive": false
    }
  ]
}
```

</br>

#### POST

This endpoint is used to create a new group. It accepts a POST request with a JSON payload containing the group's information.

**Example request:**
```http
POST /api/v1/groupes HTTP/1.1
Content-Type: application/json
Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg

{
  "nom": "Groupe 1",
  "description": "Description du groupe 1",
  "estPrive": true
}
```

**Example response:**
```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "id": 1,
  "nom": "Groupe 1",
  "description": "Description du groupe 1",
  "estPrive": true
}
```

### `/groupes/{id}`

#### GET

This endpoint is used to get a group by its id. It accepts a GET request with the group's id as a path parameter.


| Parameter | Type      | Required | Description          |
| --------- | --------- | -------- | -------------------- |
| `id`      | `integer` | `true`   | The id of the group. |

**Example request:**
```http
GET /api/v1/groupes/1 HTTP/1.1
Accept: application/json
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 1,
  "nom": "Groupe 1",
  "description": "Description du groupe 1",
  "estPrive": true
}
```

<br>

#### DELETE

This endpoint is used to delete a group by its id. It accepts a DELETE request with the group's id as a path parameter.


| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `id`                             |`integer`| `true`   | The id of the commentaire.                                                               |

**Example request:**
```http
DELETE /api/v1/groupes/1 HTTP/1.1
Accept: application/json
Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Groupe deleted"
}
```
