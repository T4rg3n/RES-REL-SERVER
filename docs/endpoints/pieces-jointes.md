<!-- TODO: Doc pour ?include sur tous les endpoints -->

### `/piecesJointes`

#### GET

This endpoint is used to get all pieces jointes. It accepts a GET request with optional query parameters.

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `perPage`                        |`integer`| `false`  | Set the number of categories per page.                                                   |
| `<key>[<operator>]=<value>`      |`string` | `false`  | Filter categories with operators like `equals`, `notEquals`, `lowerThan`, `lowerThanEquals`, `greaterThan`, `greaterThanEquals`. |

**Example request:**

```http
GET /api/v1/piecesJointes HTTP/1.1
Accept: application/json
```

**Example response:**
    
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "data": [
    {
      "id": 1,
      "type": "PDF",
      "titre": "Annexe PDF sur la situation géopolitique au Zimbabwe",
      "dateCreation": "2023-01-02 21:16:55",
      "description": "Rapport de l'ONU de 2015 au Zimbabwe",
      "contenu": "/user-files/1/pdf/1_ressource.pdf",
      "dateActivite": null,
      "lieu": null,
      "codePostal": null,
      "idUtilisateur": 1
    },
    {
      "id": 2,
      "type": "ACTIVITE",
      "titre": "Clean walk à Dijon",
      "dateCreation": "2023-03-06 12:10:02",
      "description": "Ramassage des déchets dans le centre ville de Dijon",
      "contenu": "/user-files/1/activites/1_ressource.pdf",
      "dateActivite": null,
      "lieu": null,
      "codePostal": null,
      "idUtilisateur": 5
    }
  ],
}
```

<br>

#### POST

You can create a new piece jointe by sending a POST request to `/piecesJointes` with a JSON payload containing the piece jointe's information.

**Example request:**

```http
POST /api/v1/piecesJointes HTTP/1.1
Content-Type: application/json

{
  "idUtilisateur": 1,
  "type": "PDF",
  "titre": "Annexe PDF sur la situation géopolitique au Zimbabwe",
  "description": "Lorem ipsum ceci est une description",
  "file": "C:\\Users\\user\\Documents\\file.pdf"
}
```

**Example response:**

```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "id": 1,
  "type": "PDF",
  "titre": "Annexe PDF sur la situation géopolitique au Zimbabwe",
  "dateCreation": "2023-01-02 21:16:55",
  "description": "Lorem ipsum ceci est une description",
  "contenu": "/user-files/1/pdf/1_ressource.pdf",
  "dateActivite": null,
  "lieu": null,
  "codePostal": null,
  "idUtilisateur": 1
}
```


### `/piecesJointes/{id}`

#### GET

This endpoint is used to get a piece jointe by it's id. It accepts a GET request with the piece jointe's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the piece jointe. |

**Example request:**

```http
GET /api/v1/piecesJointes/1 HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 1,
  "type": "PDF",
  "titre": "Annexe PDF sur la situation géopolitique au Zimbabwe",
  "dateCreation": "2023-01-02 21:16:55",
  "description": "Rapport de l'ONU de 2015 au Zimbabwe",
  "contenu": "/user-files/1/pdf/1_ressource.pdf",
  "dateActivite": null,
  "lieu": null,
  "codePostal": null,
  "idUtilisateur": 1
}
```

#### DELETE

This endpoint is used to delete a piece jointe by it's id. It accepts a DELETE request with the piece jointe's id as a path parameter.

| Parameter | Type      | Required | Description                |
| --------- | --------- | -------- | -------------------------- |
| `id`      | `integer` | `true`   | The id of the piece jointe. |

**Example request:**
```http
DELETE /api/v1/piecesJointes/1 HTTP/1.1 
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
    "message": "Piece jointe deleted"
}
```

### `/piecesJointes/{id}/download`
