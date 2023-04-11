## API Reference

The RESREL API is organized around [REST](https://en.wikipedia.org/wiki/Representational_state_transfer). Our API has predictable resource-oriented URLs, accepts **form-encoded** request bodies, returns [JSON-encoded responses](https://en.wikipedia.org/wiki/POST_(HTTP)#Use_for_submitting_web_forms), and uses standard HTTP response codes, authentication, and verbs.

The API is currently in beta and is subject to change. We will make a best effort to keep the documentation up to date, but if you notice any inconsistencies, please let us know.

## Rate Limiting

The RESREL API is rate limited to 60 requests per minute. If you exceed this limit, you will receive a `429 Too Many Requests` response.

You can monitor your rate limit status by checking the `X-RateLimit-Limit` and `X-RateLimit-Remaining` headers in the response.

## Authentication

### Registration
The RESREL API uses a Bearer token to authenticate requests. You will need to provide a valid username and password in order to access the API. 

To obtain a token, send a POST request to the `/api/v1/inscription` endpoint. The request body should be a JSON object with the following fields:

```json
{
  "mail": "<string>",
  "motDePasse": "<string>",
  "dateNaissance": "<string>",
  "codePostal": "<string>",
  "nom": "<string>",
  "prenom": "<string>",
  "photoProfil": "<string>",
  "bio": "<string>"
}
```

### Login

If you alrady have an account, you can obtain a new token by sending a POST request to the `/api/v1/login` endpoint. The request body should be a JSON object with the following fields:

```json
{
  "mail": "<string>",
  "motDePasse": "<string>"
}
```