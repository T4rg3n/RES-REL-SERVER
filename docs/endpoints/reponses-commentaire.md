### `/reponsesCommentaires`

#### GET

This endpoint is used to get all reponses commentaires. It accepts a GET request with optional query parameters.


| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `perPage`                        |`integer`| `false`  | Set the number of categories per page.                                                   |
| `<key>[<operator>]=<value>`      |`string` | `false`  | Filter categories with operators like `equals`, `notEquals`, `lowerThan`, `lowerThanEquals`, `greaterThan`, `greaterThanEquals`. |


**Example request:**

```http
GET /api/v1/reponsesCommentaires HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

[
  {
    "id": 1,
    "contenu": "C'est une bonne idée",
    "nombreSignalements": 0,
    "idUtilisateur": 2,
    "idCommentaire": 1,
    "datePublication": "2023-01-02 21:16:55",
    "reponseSupprime": false
  },
  {
    "id": 2,
    "contenu": "Ouep je suis d'accord",
    "nombreSignalements": 0,
    "idUtilisateur": 2,
    "idCommentaire": 1,
    "datePublication": "2023-01-02 21:16:55",
    "reponseSupprime": false
  }
]
```

#### POST

You can create a new reponse commentaire by sending a POST request to /reponsesCommentaires with a JSON payload containing the reponse commentaire's information.

**Example request:**

```http
POST /api/v1/reponsesCommentaires HTTP/1.1
Content-Type: application/json

{
  "idCommentaire": 1,
  "idUtilisateur": 2,
  "contenu": "C'est une bonne idée"
}
```

**Example response:**

```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "id": 1,
  "contenu": "C'est une bonne idée",
  "nombreSignalements": 0,
  "idUtilisateur": 2,
  "idCommentaire": 1,
  "datePublication": "2023-01-02 21:16:55",
  "reponseSupprime": false
}
```

### `/reponsesCommentaires/{id}/disable`

#### PATCH

This endpoint is used to disable a reponse commentaire by its id. It accepts a PATCH request with the reponse commentaire's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the comment response. |

**Example request:**

```http
PATCH /api/v1/reponsesCommentaires/1/disable HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Reponse disabled"
}
```

### `/reponsesCommentaires/{id}/report`

#### PATCH

This endpoint is used to report a reponse commentaire by its id. It accepts a PATCH request with the reponse commentaire's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the comment response. |

**Example request:**

```http
PATCH /api/v1/reponsesCommentaires/1/report HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Reponse reported"
}
```

### `/reponsesCommentaires/{id}`

#### GET

This endpoint is used to get a reponse commentaire by its id. It accepts a GET request with the reponse commentaire's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the comment response. |

**Example request:**

```http
GET /api/v1/reponsesCommentaires/1 HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 1,
  "contenu": "C'est une bonne idée",
  "nombreSignalements": 0,
  "idUtilisateur": 2,
  "idCommentaire": 1,
  "datePublication": "2023-01-02 21:16:55",
  "reponseSupprime": false
}
```

#### DELETE

This endpoint is used to delete a reponse commentaire by its id. It accepts a DELETE request with the reponse commentaire's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the comment response. |

**Example request:**

```http
DELETE /api/v1/reponsesCommentaires/1 HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Reponse deleted"
}
```