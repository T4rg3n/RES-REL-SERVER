## API Reference

The RESREL API is organized around [REST](https://en.wikipedia.org/wiki/Representational_state_transfer). Our API has predictable resource-oriented URLs, accepts **form-encoded** request bodies, returns [JSON-encoded responses](https://en.wikipedia.org/wiki/POST_(HTTP)#Use_for_submitting_web_forms), and uses standard HTTP response codes, authentication, and verbs.

The API is currently in beta and is subject to change. I will make a best effort to keep the documentation up to date, but if you notice any inconsistencies, [please let me know](https://github.com/T4rg3n/RES-REL-SERVER/issues/new).

## Rate Limiting

The RESREL API is rate limited to 60 requests per minute. If you exceed this limit, you will receive a `429 Too Many Requests` response.

You can monitor your rate limit status by checking the `X-RateLimit-Limit` and `X-RateLimit-Remaining` headers in the response.

## Authentication

### Registration
The RESREL API uses a **Bearer token** to authenticate requests. You will need to provide a valid username and password in order to access the API. This is a quick example, [the full documentation is available here](endpoints-summary).

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

The response in JSON will contain informations about the account you just created and a token that you can use to authenticate your requests. 

### Login

If you alrady have an account, you can obtain a new token by sending a POST request to the `/api/v1/login` endpoint. The request body should be a JSON object with the following fields:

```json
{
  "mail": "<string>",
  "motDePasse": "<string>"
}
```

The response will contain the token you can use to authenticate your requests.

### Logout

The logout is a simple GET request to the `/api/v1/logout` endpoint with the token passed in the header. There isnt any body to send with this request.