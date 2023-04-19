### `/commentaires`

<!-- TODO replace "commentaire" par "comment" -->

#### GET

This endpoint is used to get all commentaires. It accepts a GET request with optional query parameters.

| Parameter                   | Type      | Required | Description                                                                                                                    |
| --------------------------- | --------- | -------- | ------------------------------------------------------------------------------------------------------------------------------ |
| `perPage`                   | `integer` | `false`  | Set the number of categories per page.                                                                                         |
| `<key>[<operator>]=<value>` | `string`  | `false`  | Filter comments with operators like `equals`, `notEquals`, `lowerThan`, `lowerThanEquals`, `greaterThan`, `greaterThanEquals`. |

#### POST

This endpoint is used to create a new commentaire. It accepts a POST request with a JSON payload containing the commentaire's information.

**Example request:**
```http
POST /api/v1/commentaires HTTP/1.1
Content-Type: application/json
{
  "contenu": "Contenu du nouveau commentaire",
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
  "contenu": "Contenu du nouveau commentaire",
  "datePublication": "2023-01-02 21:16:55",
  "nombreReponses": 0,
  "supprime": false,
  "nombreSignalements": 0,
  "idUtilisateur": 1,
  "idRessource": 2
}
```

### `/commentaires/{id}/disable`

This endpoint is used to disable a commentaire. It accepts a PATCH request with the commentaire's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the commentaire. |


**Example request:**
```http
PATCH /api/v1/commentaires/1/disable HTTP/1.1
Accept: application/json
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Commentaire disabled"
}
```


### `/commentaires/{id}/report`

This endpoint is used to report a commentaire. It accepts a PATCH request with the commentaire's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the commentaire. |



**Example request:**
```http	
PATCH /api/v1/commentaires/1/report HTTP/1.1
Accept: application/json
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Commentaire reported"
}
```

### `/commentaires/{id}`

#### GET

This endpoint is used to get acommentby its id. It accepts a GET request with the commentaire's id as a path parameter.

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `id`                             |`integer`| `true`   | The id of thecomment                                                               |


**Example request:**
```http
GET /api/v1/commentaires/1 HTTP/1.1
Accept: application/json
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "data": {
    "id": 1,
    "dateCreation": "2023-01-02 21:16:55",
    "status": "PENDING",
    "idUtilisateur": 1,
    "contenu": "Voluptas cum sint accusamus quo officiis qui. Eum voluptatem autem aut
    "datePublication": null,
    "raisonRefus": null,
    "idRessource": 2
  }
}
```

<br>

#### DELETE

This endpoint is used to delete acomment It accepts a DELETE request with the commentaire's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the commentaire. |

**Example request:**
```http
DELETE /commentaires/1 HTTP/1.1
Accept: application/json
Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Commentaire deleted"
}
```
