### `/roles`

#### GET

This endpoint is used to get all roles as a JSON array.

**Example request:**

```http
GET /api/v1/roles HTTP/1.1
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

[
  {
    "id": 1,
    "nom": "administrateur"
  },
  {
    "id": 2,
    "nom": "utilisateur"
  }
]
```

### POST

This endpoint is used to create a new role by sending a JSON object.

**Example request:**

```http
POST /api/v1/roles HTTP/1.1
Authorization: Bearer your-access-token
Content-Type: application/json

{
  "nom": "Super modérateur",
  "ascendant": "administrateur",
  "descandant": "utilisateur"
}
```

**Example response:**

```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "id": 3,
  "nom": "Super modérateur",
  "ascendant": "administrateur",
  "descandant": "utilisateur"
}
```

### `/roles/{id}`

#### GET

This endpoint is used to get a single role by its id.

**Example request:**

```http
GET /api/v1/roles/1 HTTP/1.1
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "data": {
    "id": 1,
    "nom": "administrateur"
  }
}
```

#### DELETE

DELETE

This endpoint is used to delete a single role by its id.

**Example request:**

```http
DELETE /api/v1/roles/1 HTTP/1.1
Authorization: Bearer your-access-token
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Role deleted"
}
```