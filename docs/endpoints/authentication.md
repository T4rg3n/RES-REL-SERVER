### `/connexion`

This endpoint is used to log in a user. It accepts a POST request with a JSON payload containing the user's login credentials. The response will contain an access token that can be used for subsequent authenticated requests.

**Example request:**
```http
POST /api/v1/connexion HTTP/1.1
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
POST /api/v1/inscription HTTP/1.1
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