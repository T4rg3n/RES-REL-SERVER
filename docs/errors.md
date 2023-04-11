## Errors

### Handling Errors

To handle errors, your application should check the HTTP status code of the response. If the status code indicates an error, your application should parse the response body to obtain the error message. Your application should also implement appropriate retry logic for requests that fail due to rate limiting or server errors.

### Request Errors

If you send an invalid request, the API will respond with an error message indicating the issue. Possible errors include:

* `400 Bad Request` This error occurs if the request is missing a required parameter, contains an invalid parameter value, or is otherwise malformed.

* `401 Unauthorized`: This error occurs if your API key is invalid or has expired.

* `403 Forbidden`: This error occurs if you have exceeded your rate limit.

* `404 Not Found`: This error occurs if the requested resource is not found.

* `429 Too Many Requests` This error occurs if you have exceeded the rate limit.

### Server Errors

If the API encounters an error while processing your request, it will respond with an error message indicating the issue. Possible server errors include:

* `500 Internal Server Error`: This error occurs if there is an issue with the server.

* `502 Bad Gateway`: This error occurs if the server receives an invalid response from an upstream server.

* `503 Service Unavailable`: This error occurs if the server is temporarily unavailable.

* `504 Gateway Timeout`: This error occurs if the server does not receive a timely response from an upstream server.