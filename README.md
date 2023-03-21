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
  - [Search](#search)
  - [Adding data with POST](#adding-data-with-post)
  - [Deleting data with DELETE](#deleting-data-with-delete)
  - [Disabling resources](#disabling-resources)
  - [Reporting resources and comments](#reporting-resources-and-comments)
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

Example : `GET /api/v1/commentaires?datePublication[lowerThan]=2023-01-01`

You can also filter on multiple fields at the same time by adding a "&" between the filters. For example, if you want to get all the resources that were posted before January 1st 2023 and that have the status 'APPROVED'.

Example : `GET <api-server>/api/v1/commentaires?datePublication[lowerThan]=2023-01-01&status[equals]=APPROVED`

The API supports the following operators for filtering :

- equals (=)
- notEquals (!=)
- lowerThan (<)
- lowerThanEquals (<=)
- greaterThan (>)
- greaterThanEquals (>=)

You can filter on numerical values, dates, strings and booleans with the adapted operators.

<br>

## Search

The API support a search system. You can search for a specific resource or a specific user by submitting a POST request on the `search` endpoint. The search is case insensitive and will search for the string in all the fields of the resource or user. The search will return all the resources or users that match the search string. 

Example: `POST /api/v1/search` <br>
JSON form:
```json
{
  "ressourceQuery": "Lorem ipsum",
  "utilisateurQuery": "Gwen"
}
``` 
The request returns all resources that contain the string "Lorem ipsum" in their title, description or text content and all users that contain the string "Gwen" in their name or surname fields.

<br>

## Adding data with POST

You can add custom data to the API on the same endpoints as those you were reading from. You'll need to send an HTTP POST request that contains a JSON form. All parameters are usually required except ID.

Example: `POST /api/ressources` <br>
JSON form:
```json
{
  "titre": "Lorem ipsum",
  "contenu": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
  "idUtilisateur": 1,
  "idCategorie": 2,
  "idPieceJointe": 3
}
```

Returns:
```json
{
    "id": 103,
    "dateCreation": "2023-03-21 19:13:45",
    "status": "PENDING",
    "idUtilisateur": 1,
    "partage": "PRIVATE",
    "titre": "Bonjour",
    "contenu": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec id bibendum erat. Maecenas quis pharetra orci. Ut eget libero ornare mi commodo molestie ut in mi. Donec ornare porttitor iaculis. Pellentesque id lectus malesuada, posuere est.",
    "datePublication": null,
    "raisonRefus": null,
    "idCategorie": 1,
    "idPieceJointe": 2
}
```

Resources will be set to `PENDING` status by default. <!-- TODO: You can find more information about the status of a resource in the [status](#status) section just below.-->

<br>

## Deleting data with DELETE

Delete is available on all the endpoints. You'll need to send an HTTP DELETE request without the need to send a JSON form. The ID of the resource you want to delete is required in the URL. 

Example: `DELETE /api/ressources/1` <br>
Returns : 
```json
{
  "message": "Categorie deleted"
}
```

Beware that deleting the resource erase it from the database. The API also provide the ability to disable a resource. You can find more information about this in the [disabling resources](#disabling-resources) section just below.
<!-- TODO Beware that deleting a resource will also delete all the related data. For example, deleting a user will also delete all the comments, replies, favorites, etc. that the user has created. -->

## Disabling resources

Some endpoints support disabling. Disabling a resource means its status will be set to disabled in the database. You will also need to send a JSON form with the ID of the resource you want to disable as well as the reason you disabled it.

Example: `PATCH /api/ressource/disable` <br>
JSON form : 
```json
{ 
  "id": 51,  
  "raison": "I didn't liked it"
}
```

Returns the whole resource with the status set to "DISABLED" and the reason you provided in JSON format.

The following endpoints support disabling :
- utilisateur
- ressource
- commentaire
- reponseCommentaire

<br>

## Reporting resources and comments

You can invoke a PATCH request to report a resource or a comment. The API will then automatically increment the number of reports by one. You won't need to send a JSON form.

Example: `PATCH /api/commentaire/1/report` <br>

<br>

<!-- TODO ## Modifying data with PUT and PATCH-->

<br>

# License

This repository, as well as the Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
