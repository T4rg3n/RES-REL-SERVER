<p align="center"><a target="_blank"><img src="/logo-resrel.png?raw=true" width="400" alt="ResRel Logo"></a></p>

<img src="https://badgen.net/badge/version/1.0/green?icon=github" alt="Build Status">

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/dedf39496d3c4236a3fdf02a42c82a50)](https://app.codacy.com/gh/T4rg3n/RES-REL-SERVER/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

# Table of contents 

- [Table of contents](#table-of-contents)
- [Overview](#overview)
  - [What's "ResRel"?](#whats-resrel)
  - [About RESREL Server](#about-resrel-server)
- [API Documentation](#api-documentation)
  - [Documentation](#documentation)
  - [Swagger](#swagger)
- [Credits and license](#credits-and-license)

# Overview

## What's "ResRel"?

Ressources Relationnelles (or "ResRel" by its nickname) is a year long project for my bachelor degree.

The app is available on 2 platforms: a mobile app for Android and iOS, and a desktop website. The platform aims to improve the quality of the relationship between the citizens as well as their personnal knowledge. The entire app is organized around resources, which are the main subject of the app. A resource can be an image, a PDF, a video or a real life event. 

The project is based on a social network, where users can follow each other, like and comment on resources, and create relations between each other. You can also scroll through your feed, which is a list of resources posted by the users you follow. It comes in pair with the notification system, which allows you to be notified when a user you follow posts a new resource, or when a user accepts your relation request.

The platform also has a search engine, which allows you to search for resources by their title, description, tags, or even by the name of the user who posted it. You can also filter the results by type of resource, or by the date of publication.

##  About RESREL Server

This repository is the server part of the app, which is a REST API built with [Laravel](https://laravel.com).
It's one of the 3 repos composing *Ressources Relationnelles*, the other ones being [RES-REL-MOBILE](https://github.com/jehanvaire/RES-REL-MOBILE), build with React and React Native for mobile devices (Android & iOS), and [RES-REL-WEB](https://github.com/jehanvaire/RES-REL-WEB) built with Next.js for the desktop website. 

<br>

# API Documentation

## Documentation

The API documentation is available [here](https://docs.api.victor-gombert.fr/).
It details all the endpoints available in the API, the parameters, as well as the operators that they accept and the response they return.

## Swagger

You can also use the Swagger to get a global overview of the endpoints and to test the API, available [here](https://api.victor-gombert.fr/swagger/#/).

<br>

# Credits and license

This repository, as well as the Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
