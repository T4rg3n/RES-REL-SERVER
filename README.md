<p align="center"><a target="_blank"><img src="/logo-resrel.png?raw=true" width="400" alt="ResRel Logo"></a></p>

<p align="center">
<img src="https://badgen.net/badge/version/1.0/green?icon=github" alt="Build Status">
</p>

## What's "ResRel"?

Ressources Relationnelles (or "ResRel" by its nickname) is a year long project for my bachelor's degree. It's a multi-platform application that aims to improve the quality of the relationship between the citizens as well as their personnal knowledge. The entire app is organized around resources, which are the main subject of the app. A resource can be an image, a PDF, a video or a real life event.  

## About RESREL Server

This repository is the server part of the app, which is a REST API built with [Laravel](https://laravel.com).
It's one of the 3 repos composing *Ressources Relationnelles*, the other ones being [RES-REL-MOBILE](https://github.com/jehanvaire/RES-REL-MOBILE), build with React and React Native for mobile devices (Android & iOS), and [RES-REL-WEB](https://github.com/Pierrick2/RES-REL-WEB) built with Angular for the desktop website. 

## API Documentation

### Filtering

The API supports filtering on all the endpoints. The filtering is done by adding a GET parameter to the request. The parameter is called the same as the field you want to filter on, and the value is the value you want to filter on. 

For example, if you want to get all the resources that were posted before January 1st 2023 you can do the following request:

```
<api-server>/api/V1/commentaires?datePublication[lowerThan]=2023-01-01
```

You can also filter on multiple fields at the same time by adding a "&" between the filters. For example, if you want to get all the resources that were posted before January 1st 2023 and that have the status 'APPROVED', you can do the following request:

```
<api-server>/api/V1/commentaires?datePublication[lowerThan]=2023-01-01&status[equals]=APPROVED
```

The API supports the following operators:

- equals (=)
- notEquals (!=)
- lowerThan (<)
- lowerThanEquals (<=)
- greaterThan (>)
- greaterThanEquals (>=)

### Adding data with POST

*WIP*

### Modifying data with PUT and PATCH

*WIP*

## License

This repository, as well as the Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
