# List of endpoints

This is a detailed list of all endpoints available in the RESREL API. 
I also have a Swagger documentation [available here](https://api.victor-gombert.fr/swagger/#) that you can use to test the API.

## Authentification

### `/connexion`

This endpoint is used to log in a user. It accepts a POST request with a JSON payload containing the user's login credentials. The response will contain an access token that can be used for subsequent authenticated requests.

**Example request:**
```http
POST /connexion HTTP/1.1
Content-Type: application/json

{
"email": "johndoe@example.com",
"password": "secret"
}
```

**Example response:**
```http
HTTP/1.1 201 Created
Content-Type: application/json

{
"token": "1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg",
"idUti": 1
}
```

### `/inscription`

This endpoint is used to register a new user. It accepts a POST request with a JSON payload containing the user's login credentials. 

The response will contain an access token that can be used for subsequent authenticated requests. If you want to upload a profile picture, you can pass it in the form data as a file. If there is no profile picture, the user will have a default profile picture.

<!-- TODO: Add table of fields that are required and optional. -->

**Example request:**
```http
POST /inscription HTTP/1.1
Content-Type: application/json

{
  "mail": "john.doe@gmail.com",
  "motDePasse": "password01",
  "dateNaissance": "2002-01-02 00:00:00",
  "codePostal": 75000,
  "nom": "Doe",
  "prenom": "John",
  "photoProfil": "photoProfil=@\"/C:/Users/user/Desktop/profile_picture_resrel.jpg",
  "bio": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl vitae ultricies lacinia, nunc nisl aliquet nisl, eget aliquet nunc nisl eget nunc. Sed euismod, nisl vitae ultricies lacinia, nunc nisl aliquet nisl, eget aliquet nunc nisl eget nunc."
}
```

**Example response:**
```http
HTTP/1.1 201 Created
Content-Type: application/json

{
"response": {
    "id": 1,
    "mail": "john.doe@gmail.com",
    "motDePasse": "ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad",
    "dateInscription": "2023-01-02 21:16:55",
    "dateNaissance": "2002-01-02 00:00:00",
    "codePostal": "75000",
    "nom": "Doe",
    "prenom": "John",
    "bio": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl vitae ultricies lacinia, nunc nisl aliquet nisl, eget aliquet nunc nisl eget nunc. Sed euismod, nisl vitae ultricies lacinia, nunc nisl aliquet nisl, eget aliquet nunc nisl eget nunc.",
    "compteActif": true,
    "raisonBan": "nulSl",
    "idRole": 4
  }
},
{
    "token": "1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg"
}
```

### `/deconnexion`

This endpoint is used to log out a user. It accepts a GET request without any body. You will need to pass the Bearer in the header however. The response will contain a message confirming that the user has been logged out.

**Example request:**
```http
GET /api/v1/deconnexion HTTP/1.1
Accept: application/json
Authorization: Bearer 1|EojGLORUas6xz0OmRvuaZ4ReNhjqVVM5pdcUevJg
```

**Example response:**
```json
{
    "message": "Logged out successfully."
}
```


## Categories

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

## Commentaires

### `/commentaires`

#### GET

This endpoint is used to get all commentaires. It accepts a GET request with optional query parameters.

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `perPage`                        |`integer`| `false`  | Set the number of categories per page.                                                   |
| `<key>[<operator>]=<value>`      |`string` | `false`  | Filter comments with operators like `equals`, `notEquals`, `lowerThan`, `lowerThanEquals`, `greaterThan`, `greaterThanEquals`. |

#### POST

This endpoint is used to create a new commentaire. It accepts a POST request with a JSON payload containing the commentaire's information.

**Example request:**
```http
POST /commentaires HTTP/1.1
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

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `id`                             |`integer`| `true`   | The id of the commentaire.                                                               |


**Example request:**
```http
PATCH /commentaires/1/disable HTTP/1.1
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

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `id`                             |`integer`| `true`   | The id of the commentaire.                                                               |



**Example request:**
```http	
PATCH /commentaires/1/report HTTP/1.1
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

This endpoint is used to get a commentaire by its id. It accepts a GET request with the commentaire's id as a path parameter.


**Example request:**
```http
GET /commentaires/1 HTTP/1.1
Accept: application/json
```

**Example response:**
HTTP/1.1 200 OK
Content-Type: application/json

```
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

#### DELETE

This endpoint is used to delete a commentaire. It accepts a DELETE request with the commentaire's id as a path parameter.

| Parameter                        | Type    | Required | Description                                                                              |
|----------------------------------|---------|----------|------------------------------------------------------------------------------------------|
| `id`                             |`integer`| `true`   | The id of the commentaire.                                                               |

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

## Favorites

### `/favoris`

### `/favoris/{id}`

## Groups

### `/groupes`

### `/groupes/{id}`

## Pieces jointes

### `/piecesJointes`

### `/piecesJointes/{id}`

### `/piecesJointes/{id}/download`

## Relations

### `/relations`

### `/relations/{id}`

## Comment responses

### `/reponsesCommentaires`

### `/reponsesCommentaires/{id}/disable`

### `/reponsesCommentaires/{id}/report`

### `/reponsesCommentaires/{id}`

## Resources

### `/ressources`

### `/ressources/{id}`

## Roles

### `/roles`

### `/roles/{id}`

## Rechercher

### `/rechercher`

If you need to search for resources or users, you can use this endpoint. It accepts a POST request with a JSON payload containing the search parameters. The response will contain a list of resources or users that match the search parameters.

You can either search for resources or users, or both. If you want to include ressources authors, you can pass the `include` parameter in the `ressource` object. The `include` parameter takes an array of strings. 

**Example request:**
```http
POST /api/v1/rechercher HTTP/1.1
Accept: application/json
Content-Type: application/json

{
    "query": {
        "ressource": {
            "q": "ipsum",
            "include": ["utilisateur"]
        },
        "utilisateur": {
            "q": "John"
        }
    }
}
```

**Example response :**
```json
{
    "ressources": [
        {
            "id": 2481,
            "dateCreation": "2023-04-04 19:17:05",
            "status": "APPROVED",
            "idUtilisateur": 902,
            "utilisateur": {
                "id": 902,
                "mail": "kohler.demetris@schumm.net",
                "dateInscription": "1970-03-12 00:00:00",
                "dateNaissance": "2006-07-08 00:00:00",
                "codePostal": "22371",
                "nom": "Haag",
                "prenom": "Garnet",
                "bio": "Fugiat ducimus vel voluptate optio tenetur id. Provident est quis voluptatibus et. Itaque quod corrupti unde ex fugit. Quos odio inventore id aut in reiciendis qui.",
                "compteActif": 1,
                "raisonBan": null,
                "idRole": 2
            },
            "partage": "RESTRICTED",
            "titre": "Est officiis necessitatibus ipsum esse.",
            "contenu": "Voluptatem distinctio similique magni architecto esse ipsa. Doloribus non voluptas eaque omnis quae laudantium. Nesciunt omnis quos cupiditate. Quasi nesciunt qui porro aut quisquam.",
            "datePublication": "1971-06-25 10:19:51",
            "raisonRefus": null,
            "idCategorie": 13,
            "idPieceJointe": 207
        },
    ],
   "utilisateurs": [
        {
            "id": 129,
            "mail": "gleason.etha@hotmail.com",
            "dateInscription": "1980-01-09 00:00:00",
            "dateNaissance": "1986-06-02 00:00:00",
            "codePostal": "67589",
            "nom": "Johnston",
            "prenom": "Alexandra",
            "bio": "Et necessitatibus consequatur voluptate asperiores perspiciatis deserunt. Fugit nam fugit maiores incidunt deleniti. Et ex maxime in est quos accusamus doloremque. Eum eos iure ut non neque qui.",
            "compteActif": 1,
            "raisonBan": null,
            "idRole": 2
        },
   ]
}
```

## Relation types

### `/typesRelations`

### `/typesRelations/{id}`

## Users

### `//utilisateurs/{id}`

### `//utilisateurs/{id}/download`