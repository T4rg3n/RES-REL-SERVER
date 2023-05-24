### `/relations`

#### GET

This endpoint is used to get all relations. It accepts a GET request with optional query parameters.

| Parameter                   | Type      | Required | Description                                                                                                                      |
| --------------------------- | --------- | -------- | -------------------------------------------------------------------------------------------------------------------------------- |
| `perPage`                   | `integer` | `false`  | Set the number of categories per page.                                                                                           |
| `<key>[<operator>]=<value>` | `string`  | `false`  | Filter categories with operators like `equals`, `notEquals`, `lowerThan`, `lowerThanEquals`, `greaterThan`, `greaterThanEquals`. |
| `fromUtilisateur`           | `integer` | `false`  | Get the completed relations that the used passed in parameters have                                                              |

**Example request:**

```http
GET /api/v1/relations HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

"data": [
  {
    "id": 1,
    "typeRelation": 2,
    "idDemandeur": 1000,
    "idReceveur": 310,
    "dateDemande": "2023-04-14 14:14:48",
    "dateAcceptation": null,
    "accepte": 0
  },
  {
    "id": 2,
    "typeRelation": 2,
    "idDemandeur": 521,
    "idReceveur": 237,
    "dateDemande": "2022-05-24 16:30:12",
    "dateAcceptation": null,
    "accepte": null
  },
  ...
```

#### POST

You can create a new relation by sending a POST request to /relations with a JSON payload containing the relation's information.

**Example request:**

```http
POST /api/v1/relations HTTP/1.1
Content-Type: application/json

{
  "idDemandeur": 1
  "idReceveur" : 2
  "typeRelation" : 1
}
```

**Example response:**

```http
HTTP/1.1 201 Created
Content-Type: application/json

{
  "id": 1,
  "typeRelation": 1,
  "idDemandeur": 1,
  "idReceveur": 2,
  "dateDemande": "2022-05-24 16:30:12",
  "dateAcceptation": null,
  "accepte": null
}
```

### `/relations/{id}`

#### GET

This endpoint is used to get a relation by its id. It accepts a GET request with the relation's id as a path parameter.

| Parameter | Type      | Required | Description            |
| --------- | --------- | -------- | ---------------------- |
| `id`      | `integer` | `true`   | The id of the relation |

**Example request:**

```http
GET /api/v1/relations/1 HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 1,
  "typeRelation": 2,
  "idDemandeur": 521,
  "idReceveur": 237,
  "dateDemande": "2022-05-24 16:30:12",
  "dateAcceptation": null,
  "accepte": null
}
```

#### DELETE

This endpoint is used to delete a relation by its id. It accepts a DELETE request with the relation's id as a path parameter.

| Parameter | Type      | Required | Description            |
| --------- | --------- | -------- | ---------------------- |
| `id`      | `integer` | `true`   | The id of the relation |

**Example request:**

```http
DELETE /api/v1/relations/1 HTTP/1.1
Accept: application/json
```

**Example response:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
"message": "Relation deleted"
}
```
