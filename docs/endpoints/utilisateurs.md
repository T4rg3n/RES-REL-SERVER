### `/utilisateurs`

#### GET

This endpoint is used to get all utilisateurs. It accepts optional query parameters to set the number of utilisateurs per page and to filter utilisateurs using operators.

**Example request:**

```http
GET /api/v1/utilisateurs HTTP/1.1
Accept: application/json

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

[
  {
    "id": 1,
    "mail": "john.doe@gmail.com",
    "dateInscription": "2023-01-02 21:16:55",
    "dateNaissance": "2002-01-02 00:00:00",
    "codePostal": 75000,
    "nom": "Doe",
    "prenom": "John",
    "bio": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl vitae ultricies lacinia, nunc nisl aliquet nisl, eget aliquet nunc nisl eget nunc. Sed euismod, nisl vitae ultricies lacinia, nunc nisl aliquet nisl, eget aliquet nunc nisl eget nunc.",
    "compteActif": true,
    "raisonBan": null,
    "idRole": 1
  },
  ...
]
```

### `/utilisateur/disable`

#### POST

This endpoint is used to disable (ban) an utilisateur. It accepts a POST request with a JSON object containing the utilisateur's id and the ban reason.

**Example request:**

```http
POST /api/v1/utilisateur/disable HTTP/1.1
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
Content-Type: application/json

{
  "id": 1,
  "raison": "Raison du bannissement"
}
```

**Example response:**

```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "message": "Utilisateur disabled"
}
```

### `/utilisateur/{id}/download`

#### GET

This endpoint is used to download a user's profile picture by its id. It accepts a GET request with the user's id as a path parameter.

**Example request:**

```http
GET /api/v1/utilisateur/1/download HTTP/1.1
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: image/jpeg
Content-Disposition: attachment; filename="1_photoProfil.jpg"

(binary image data)
```

### `/utilisateurs/{id}`

#### GET

This endpoint is used to get a single utilisateur by its id. It accepts a GET request with the utilisateur's id as a path parameter.

**Example request:**

```http
GET /api/v1/utilisateurs/1 HTTP/1.1
Accept: application/json
```

**Example response:**

```http

HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 1,
  "mail": "john.doe@gmail.com",
  "dateInscription": "2023-01-02 21:16:55",
  "dateNaissance": "2002-01-02 00:00:00",
  "codePostal": 75000,
  "nom": "Doe",
  "prenom": "John",
  "John",
  "bio": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl vitae ultricies lacinia, nunc nisl aliquet nisl, eget aliquet nunc nisl eget nunc. Sed euismod, nisl vitae ultricies lacinia, nunc nisl aliquet nisl, eget aliquet nunc nisl eget nunc.",
  "compteActif": true,
  "raisonBan": null,
  "idRole": 1
}
```

#### DELETE

This endpoint is used to delete an utilisateur by its id. It accepts a DELETE request with the utilisateur's id as a path parameter.

**Example request:**

```http
DELETE /api/v1/utilisateurs/1 HTTP/1.1
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "message": "Utilisateur deleted"
}
```