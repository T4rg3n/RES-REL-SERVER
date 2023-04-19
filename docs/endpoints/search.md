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
