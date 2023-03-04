<p align="center"><a target="_blank"><img src="/logo-resrel.png?raw=true" width="400" alt="ResRel Logo"></a></p>

<p align="center">
<img src="https://badgen.net/badge/version/1.0/green?icon=github" alt="Build Status">
</p>


# Table of contents 

- [Table of contents](#table-of-contents)
- [Overview](#overview)
  - [What's "ResRel"?](#whats-resrel)
  - [About RESREL Server](#about-resrel-server)
- [API Documentation](#api-documentation)
  - [Filtering data](#filtering-data)
    - [Endpoints list](#endpoints-list)
  - [Search](#search)
  - [Adding data with POST](#adding-data-with-post)
  - [Deleting data with DELETE](#deleting-data-with-delete)
  - [Disabling resources](#disabling-resources)
  - [Reporting resources and comments](#reporting-resources-and-comments)
  - [Modifying data with PUT and PATCH](#modifying-data-with-put-and-patch)
- [License](#license)

# Overview

## What's "ResRel"?

Ressources Relationnelles (or "ResRel" by its nickname) is a year long project for my bachelor's degree. It's a multi-platform application that aims to improve the quality of the relationship between the citizens as well as their personnal knowledge. The entire app is organized around resources, which are the main subject of the app. A resource can be an image, a PDF, a video or a real life event.  

##  About RESREL Server

This repository is the server part of the app, which is a REST API built with [Laravel](https://laravel.com).
It's one of the 3 repos composing *Ressources Relationnelles*, the other ones being [RES-REL-MOBILE](https://github.com/jehanvaire/RES-REL-MOBILE), build with React and React Native for mobile devices (Android & iOS), and [RES-REL-WEB](https://github.com/Pierrick2/RES-REL-WEB) built with Angular for the desktop website. 

<br>

# API Documentation
## Filtering data

The API supports filtering on all the endpoints. The filtering is done by adding a GET parameter to the request. The parameter is called the same as the field you want to filter on, and the value is the value you want to filter on. 

For example, if you want to get all the resources that were posted before January 1st 2023 you can do the following request:

```
<api-server>/api/v1/commentaires?datePublication[lowerThan]=2023-01-01
```

You can also filter on multiple fields at the same time by adding a "&" between the filters. For example, if you want to get all the resources that were posted before January 1st 2023 and that have the status 'APPROVED', you can do the following request:

```
<api-server>/api/v1/commentaires?datePublication[lowerThan]=2023-01-01&status[equals]=APPROVED
```

**Note that the 'v1' is in lowercase.** I'm also working on getting rid of the /api/ as it's already declared in the subdomain.

The API supports the following operators for filtering :

- equals (=)
- notEquals (!=)
- lowerThan (<)
- lowerThanEquals (<=)
- greaterThan (>)
- greaterThanEquals (>=)

<br>

### Endpoints list

However not all fields are filterable. Here is the complete list of all the endpoints of the API that support filtering in the current API version :

<!-- TODO Refactor this -->
| Table | Field | Equals</br><p align="center">=</p> | LowerThan <p align="center"><</p> | LowerThanEquals <p align="center"><=</p> | GreaterThan <p align="center">></p> | GreaterThanEquals <p align="center">>=</p> |
|-------|--------|------------|-----------|-----------------|-------------|-------------------|
categories | id |<p align="center"> ✓ </p>| |  |  |  |  |
categories | nom |<p align="center"> ✓ </p>|  |  |  |  |  |
commentaires | idUtilisateur |<p align="center"> ✓ </p>| |  |  |  |  |
commentaires | datePublication |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
commentaires | nombreReponses |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
commentaires | supprime |<p align="center"> ✓ </p>| |  |  |  |  |
commentaires | nombreSignalements |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
favoris | dateFav |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
favoris | idUtilisateur |<p align="center"> ✓ </p>| |  |  |  |  |
favoris | idRessource |<p align="center"> ✓ </p>| |  |  |  |  |
groupes | nom |<p align="center"> ✓ </p>| |  |  |  |  |
groupes | estPrive |<p align="center"> ✓ </p>| |  |  |  |  |
piecesJointes | type |<p align="center"> ✓ </p>| |  |  |  |  |
piecesJointes | titre |<p align="center"> ✓ </p>| |  |  |  |  |
piecesJointes | dateCreation |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
piecesJointes | dateActivite |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
piecesJointes | lieu |<p align="center"> ✓ </p>| |  |  |  |  |
piecesJointes | codePostal |<p align="center"> ✓ </p>| |  |  |  |  |
piecesJointes | idUtilisateur |<p align="center"> ✓ </p>| |  |  |  |  |
relations | idDemandeur |<p align="center"> ✓ </p>| |  |  |  |  |
relations | idReceveur |<p align="center"> ✓ </p>| |  |  |  |  |
relations | accepte |<p align="center"> ✓ </p>| |  |  |  |  |
reponsesCommentaires | datePublication |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
reponsesCommentaires | supprime |<p align="center"> ✓ </p>| |  |  |  |  |
reponsesCommentaires | nombreSignalement |<p align="center"> ✓ </p>| |  |  |  |  |
reponsesCommentaires | idUtilisateur |<p align="center"> ✓ </p>| |  |  |  |  |
reponsesCommentaires | idCommentaire |<p align="center"> ✓ </p>| |  |  |  |  |
ressources | id |<p align="center"> ✓ </p>| |  |  |  |  |
ressources | dateCreation |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
ressources | status |<p align="center"> ✓ </p>| |  |  |  |  |
ressources | idUtilisateur |<p align="center"> ✓ </p>| |  |  |  |  |
ressources | datePublication |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
ressources | idCategorie |<p align="center"> ✓ </p>| |  |  |  |  |
utilisateurs | id  |<p align="center"> ✓ </p>| |  |  |  |  |
utilisateurs | mail |<p align="center"> ✓ </p>| |  |  |  |  |
utilisateurs | dateInscription |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
utilisateurs | dateNaissance |<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|<p align="center"> ✓ </p>|
utilisateurs | codePostal |<p align="center"> ✓ </p>| |  |  |  |  |
utilisateurs | nom |<p align="center"> ✓ </p>| |  |  |  |  |
utilisateurs | prenom |<p align="center"> ✓ </p>| |  |  |  |  |
utilisateurs | cheminPhoto |<p align="center"> ✓ </p>| |  |  |  |  |
utilisateurs | urlProfil |<p align="center"> ✓ </p>| |  |  |  |  |
utilisateurs | compteActif |<p align="center"> ✓ </p>| |  |  |  |  |

[Back to table of contents](#table-of-contents)

</br>

## Search

<!-- TODO -->
The API support a search system. You can search for a specific resource by using the `search` parameter. The search is case insensitive and will search for the string in all the fields of the table.


<br>

## Adding data with POST

You can add custom data to the API on the same endpoints as those you were reading from. You'll need to send an HTTP POST request that contains a JSON form. All parameters are required except ID.

<br>

## Deleting data with DELETE

Delete is available on all the endpoints. You'll need to send an HTTP DELETE request without the need to send a JSON form. The ID of the resource you want to delete is required in the URL. 

Example: `DELETE /api/ressources/1` <br>
Returns : `{"message": "Categorie deleted"}`
<br>

Beware that deleting the resource erase it from the database. The API also provide the ability to disable a resource. You can find more information about this in the [disabling resources](#disabling-resources) section just below.
<!-- TODO 
Beware that deleting a resource will also delete all the related data. For example, deleting a user will also delete all the comments, replies, favorites, etc. that the user has created.
-->

## Disabling resources

Some endpoints support disabling. Disabling a resource means its status will be set to disabled in the database. You will also need to send a JSON form with the ID of the resource you want to disable as well as the reason you disabled it.

Example: `PATCH /api/ressource/disable` <br>
JSON form : `{ "id": 51,  "raison": "I didnt liked it"}`

Returns the whole resource with the status set to "DISABLED" and the reason you provided in JSON format.

The following endpoints support disabling :
- utilisateur
- ressource
- commentaire
- reponseCommentaire

Note that the endpoints are in singular form, as we are operating on a single resource.
<br>


## Reporting resources and comments

You can invoke a PATCH request to report a resource or a comment. The API will then automatically increment the number of reports by one. You wont need to send a JSON form.

Example: `PATCH /api/commentaire/1/report` <br>

Here again, the endpoints are in singular form.

<br>

## Modifying data with PUT and PATCH

*WIP*

<br>

# License

This repository, as well as the Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
