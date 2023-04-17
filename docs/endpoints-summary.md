# Endpoints Summary

| Section                                                | Endpoint                                                                         | Method | Authenticated | Description                         |
| ------------------------------------------------------ | -------------------------------------------------------------------------------- | ------ | ------------- | ----------------------------------- |
| [Authentication](/endpoints#Authentication)            |                                                                                  |        |               |                                     |
|                                                        | [/connexion](/endpoints#connexion)                                               | POST   | false         | Log in a user                       |
|                                                        | [/inscription](/endpoints#inscription)                                           | POST   | false         | Register a new user                 |
|                                                        | [/deconnexion](/endpoints#deconnexion)                                           | GET    | true          | Log out a user                      |
| [Categories](/endpoints#Categories)                    |                                                                                  |        |               |                                     |
|                                                        | [/categories](/endpoints#get-categories)                                         | GET    | false         | List all categories                 |
|                                                        | [/categories/{id}](/endpoints#categories-id)                                     | GET    | false         | Get a category by ID                |
|                                                        |                                                                                  | DELETE | true          | Delete a category by ID             |
| [Commentaires](/endpoints#Commentaires)                |                                                                                  |        |               |                                     |
|                                                        | [/commentaires](/endpoints#commentaires)                                         | GET    | false         | List all commentaires               |
|                                                        |                                                                                  | POST   | true          | Create a commentaire                |
|                                                        | [/commentaires/{id}](/endpoints#commentaires-id)                                 | GET    | false         | Get a commentaire by ID             |
|                                                        |                                                                                  | DELETE | true          | Delete a commentaire by ID          |
|                                                        | [/commentaires/{id}/disable](/endpoints#commentaires-id-disable)                 | PATCH  | true          | Disable a commentaire by ID         |
|                                                        | [/commentaires/{id}/report](/endpoints#commentaires-id-report)                   | PATCH  | true          | Report a commentaire by ID          |
| [Favoris](/endpoints#Favoris)                          |                                                                                  |        |               |                                     |
|                                                        | [/favoris](/endpoints#favoris)                                                   | GET    | false         | List all favoris                    |
|                                                        |                                                                                  | POST   | true          | Create a favori                     |
|                                                        | [/favoris/{id}](/endpoints#favoris-id)                                           | GET    | false         | Get a favori by ID                  |
|                                                        |                                                                                  | DELETE | true          | Delete a favori by ID               |
| [Groupes](/endpoints#Groupes)                          |                                                                                  |        |               |                                     |
|                                                        | [/groupes](/endpoints#groupes)                                                   | GET    | true          | List all groupes                    |
|                                                        |                                                                                  | POST   | true          | Create a groupe                     |
|                                                        | [/groupes/{id}](/endpoints#groupes-id)                                           | GET    | true          | Get a groupe by ID                  |
|                                                        |                                                                                  | DELETE | true          | Delete a groupe by ID               |
| [Pieces jointes](/endpoints#PiecesJointes)             |                                                                                  |        |               |                                     |
|                                                        | [/piecesJointes](/endpoints#piecesJointes)                                       | GET    | false         | List all pieces jointes             |
|                                                        |                                                                                  | POST   | true          | Create a piece jointe               |
|                                                        | [/piecesJointes/{id}](/endpoints#piecesJointes-id)                               | GET    | false         | Get a piece jointe by ID            |
|                                                        |                                                                                  | DELETE | true          | Delete a piece jointe by ID         |
|                                                        | [/piecesJointes/{id}/download](/endpoints#piecesJointes-id-download)             | PATCH  | true          | Download a piece jointe by ID       |
| [Relations](/endpoints#Relations)                      |                                                                                  |        |               |                                     |
|                                                        | [/relations](/endpoints#relations)                                               | GET    | true          | List all relations                  |
|                                                        |                                                                                  | POST   | true          | Create a relation                   |
|                                                        | [/relations/{id}](/endpoints#relations-id)                                       | GET    | true          | Get a relation by ID                |
|                                                        |                                                                                  | DELETE | true          | Delete a relation by ID             |
| [Reponse commentaires](/endpoints#ReponseCommentaires) |                                                                                  |        |               |                                     |
|                                                        | [/reponsesCommentaires](/endpoints#reponsesCommentaires)                         | GET    | false         | List all reponse commentaires       |
|                                                        |                                                                                  | POST   | true          | Create a reponse commentaire        |
|                                                        | [/reponsesCommentaires/{id}](/endpoints#reponsesCommentaires-id)                 | GET    | false         | Get a reponse commentaire by ID     |
|                                                        | [/reponsesCommentaires/{id}/disable](/endpoints#reponsesCommentaires-id-disable) | PATCH  | true          | Disable a reponse commentaire by ID |
|                                                        | [/reponsesCommentaires/{id}/report](/endpoints#reponsesCommentaires-id-report)   | PATCH  | true          | Report a reponse commentaire by ID  |
|                                                        |                                                                                  | DELETE | true          | Delete a reponse commentaire by ID  |
| [Ressources](/endpoints#Ressources)                    |                                                                                  |        |               |                                     |
|                                                        | [/ressources](/endpoints#ressources)                                             | GET    | false         | List all ressources                 |
|                                                        |                                                                                  | POST   | true          | Create a ressource                  |
|                                                        | [/ressources/{id}](/endpoints#ressources-id)                                     | GET    | false         | Get a ressource by ID               |
|                                                        |                                                                                  | DELETE | true          | Delete a ressource by ID            |
| [Recherche](/endpoints#Recherche)                      |                                                                                  |        |               |                                     |
|                                                        | [/rechercher](/endpoints#rechercher)                                             | GET    | false         | Search                              |
| [Types relation](/endpoints#TypesRelation)             |                                                                                  |        |               |                                     |
|                                                        | [/typesRelation](/endpoints#typesRelation)                                       | GET    | false         | List all types relation             |
|                                                        |                                                                                  | POST   | true          | Create a type relation              |
|                                                        | [/typesRelation/{id}](/endpoints#typesRelation-id)                               | GET    | false         | Get a type relation by ID           |
|                                                        |                                                                                  | DELETE | true          | Delete a type relation by ID        |
| [Utilisateurs](/endpoints#Utilisateurs)                |                                                                                  |        |               |                                     |
|                                                        | [/utilisateurs](/endpoints#utilisateurs)                                         | GET    | false         | List all utilisateurs               |
|                                                        | [/utilisateur/disable](/endpoints#utilisateur-disable)                           | POST   | true          | Disable a utilisateur               |
|                                                        | [/utilisateur/{id}/download](/endpoints#utilisateur-id-download)                 | GET    | false         | Download a utilisateur by ID        |
|                                                        | [/utilisateurs/{id}](/endpoints#utilisateurs-id)                                 | GET    | false         | Get a utilisateur by ID             |
|                                                        |                                                                                  | DELETE | true          | Delete a utilisateur by ID          |

<!-- Authentification: enpoints//endpoints#authentification
Categories: enpoints//endpoints#categories
Comments: enpoints//endpoints#comments
      - Favorites: enpoints//endpoints#favorites
      - Groups: enpoints//endpoints#groups
      - Pieces jointes: enpoints//endpoints#pieces-jointes
      - Relations: enpoints//endpoints#relations
      - Comment responses: enpoints//endpoints#comment-responses
      - Resources: enpoints//endpoints#resources
      - Roles: enpoints//endpoints#roles
      - Search: enpoints//endpoints#search
      - Relation types: enpoints//endpoints#relation-types
      - Users: enpoints//endpoints#users

Authentification
/connexion POST
/inscription POST
/deconnexion GET

Categories
/categories GET
/categories/{id} GET, DELETE

Commentaires
/commentaires GET, POST
/commentaires/{id} GET, DELETE
/commentaires/{id}/disable PATCH
/commentaires/{id}/report PATCH

Favoris
/favoris GET, POST
/favoris/{id} GET, DELETE

Groupes
/groupes GET, POST
/groupes/{id} GET, DELETE

Pieces jointes
/piecesJointes GET, POST
/piecesJointes/{id} GET, DELETE
/piecesJointes/{id}/download PATCH

Relations
/relations GET, POST
/relations/{id} GET, DELETE

Reponse commentaires
/reponsesCommentaires GET, POST
/reponsesCommentaires/{id}/disable PATCH
/reponsesCommentaires/{id}/report PATCH
/reponsesCommentaires/{id} GET, DELETE

Ressources
/ressources GET, POST
/ressources/{id} GET, DELETE

Recherche :
/rechercher GET

Types relation:
/typesRelation GET, POST
/typesRelation/{id} GET, DELETE

Utilisateurs
/utilisateurs GET
/utilisateur/disable POST
/utilisateur/{id}/downalod GET
/utilisateurs/{id} GET, DELETE -->