### `/typesRelation`

#### GET

This endpoint is used to get all types of relations. It accepts a GET request without any additional parameters.

**Example request:**

```http
GET /api/v1/typesRelation HTTP/1.1
Accept: application/json
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

[
  {
    "id": 1,
    "nom": "Ami"
  },
  {
    "id": 2,
    "nom": "Collègue"
  },
  ...
]
```

#### POST

This endpoint is used to create a new type of relation. It accepts a POST request with a JSON object containing the type of relation details.

**Example request:**
```http
POST /api/v1/typesRelation HTTP/1.1
Accept: application/json

{
  "name": "New type of relation"
}
```

**Example response:**
```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "id": 3,
  "nom": "New type of relation"
}
```

### `/typesRelation/{id}`

#### GET

This endpoint is used to get a single type of relation by its id. It accepts a GET request with the type of relation's id as a path parameter.

**Example request:**

```http
GET /api/v1/typesRelation/1 HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 1,
  "name": "Type of relation 1"
}
```

#### DELETE

This endpoint is used to delete a type of relation by its id. It accepts a DELETE request with the type of relation's id as a path parameter.

**Example request:**

```http
DELETE /api/v1/typesRelation/1 HTTP/1.1
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Type relation deleted"
}
```