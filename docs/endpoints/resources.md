## Resources

### `/ressources`

#### GET

This endpoint is used to get all ressources. It accepts optional query parameters to set the number of ressources per page and to filter ressources using operators.

**Example request:**

```http
GET /api/v1/ressources HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

[
  {
    "id": 1,
    "dateCreation": "2023-01-02 21:16:55",
    "status": "PENDING",
    "idUtilisateur": 1,
    "partage": "PRIVATE",
    "titre": "Quis dolores repellendus fuga ut sit perferendis.",
    "contenu": "Voluptas cum sint accusamus quo officiis qui. Eum voluptatem autem aut nisi. Quae molestiae optio et ut. Voluptatem vel hic temporibus ea animi magni totam.",
    "datePublication": null,
    "raisonRefus": null,
    "idCategorie": 2
  },
  ...
]
```

#### POST

This endpoint is used to create a new ressource. It accepts a POST request with a JSON object containing the ressource details.

**Example request:**

```http
POST /api/v1/ressources HTTP/1.1
Accept: application/json

{
  "titre": "Ajout d'une nouvelle ressource",
  "contenu": "Contenu de la nouvelle ressource",
  "idUtilisateur": 1,
  "idCategorie": 2,
  "idPieceJointe": 3
}
```

**Example response:**

```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "titre": "Ajout d'une nouvelle ressource",
  "contenu": "Contenu de la nouvelle ressource",
  "idUtilisateur": 1,
  "idCategorie": 2,
  "idPieceJointe": 3
}
```

### `/ressources/{id}`

#### GET

This endpoint is used to get a single ressource by its id. It accepts a GET request with the ressource's id as a path parameter.

**Example request:**

```http
GET /api/v1/ressources/1 HTTP/1.1
Accept: application/json

```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 1,
  "dateCreation": "2023-01-02 21:16:55",
  "status": "PENDING",
  "idUtilisateur": 1,
  "partage": "RESTRICTED",
  "titre": "Quis dolores repellendus fuga ut sit perferendis.",
  "contenu": "Voluptas cum sint accusamus quo officiis qui. Eum voluptatem autem aut nisi. Quae molestiae optio et ut. Voluptatem vel hic temporibus ea animi magni totam.",
  "datePublication": null,
  "raisonRefus": null,
  "idCategorie": 2,
  "idPieceJointe": 3
}

```

#### DELETE

This endpoint is used to delete a ressource by its id. It accepts a DELETE request with the ressource's id as a path parameter.

**Example request:**

```http
DELETE /api/v1/ressources/1 HTTP/1.1
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Ressource deleted"
}
```

### `/ressources/{id}/disable`

#### PATCH

This endpoint is used to refuse a ressource. It accepts a PATCH request with a JSON object containing the ressource's id and the refusal reason.

**Example request:**

```http
PATCH /api/v1/ressources/disable HTTP/1.1
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
Content-Type: application/json

{
  "id": 1,
  "raison": "Raison du refus"
}
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Ressource refused"
}
```

### `/ressources/{id}/enable`

#### PATCH

This endpoint is used to accept a ressource. It accepts a PATCH request with the ressource's id as a path parameter.

**Example request:**

```http
PATCH /api/v1/ressources/1/enable HTTP/1.1
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Ressource accepted"
}
```