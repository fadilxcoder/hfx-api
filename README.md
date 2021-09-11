# HFX API

## Database

- **Users Table**
- - id_user
- - uuid
- - username
- - name
- - address
- - job
- - card

## Endpoint

- **GET** http://dev.api.hfx.local/v1/users
- **GET** http://dev.api.hfx.local/v1/users/3
- **POST** http://dev.api.hfx.local/v1/users
- **DELETE** http://dev.api.hfx.local/v1/users/17

# Notes

- Use **double quotes** when sending JSON body when doing a POST
- https://en.wikipedia.org/wiki/List_of_HTTP_status_codes (List of HTTP status codes)
- POST input data format :
```
{
  "uuid": "XXXXXXXXXXX-XXX-XXXX-XXXX-XXXXXXXXXXXX",
  "username": "fadilxcoder",
  "name": "FADIL X",
  "address": "1285 Schumm Forks South Shyanne, DE 86167",
  "job": "Web Architect",
  "card": "MasterCard"
}
```