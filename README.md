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
- **PUT** http://dev.api.hfx.local/v1/users/25

# Notes

- Expose online over secure tunnels : `./ngrok.sh`
- Use **double quotes** when sending JSON body when doing a POST
- https://en.wikipedia.org/wiki/List_of_HTTP_status_codes (List of HTTP status codes)
- https://packagist.org/packages/nikic/fast-route Fast request router for PHP documentation
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
- https://onlinestringtools.com/generate-random-string (Random keys string generator)
- Authorization Bearer verification in `Controller.php` & bearer creation in `EncryptCommand.php`
- Use command `php bin/console openssl:keys encrypt` to display Authorization Bearer

- https://packagist.org/packages/evenement/evenement (Événement is a very simple event dispatching library for PHP)
- `composer require evenement/evenement`

# Tunnel 


- **Static** Crypto.js  [https://github.com/fadilxcoder/cryoto-js.git] --> **PHP** Reverse proxy [https://github.com/fadilxcoder/reverse-proxy.git] --> **PHP** HFX Api server
- Launch app by `php -S 127.0.0.1:3052 -t public/`
- Port forward app `lt --port 3052 --subdomain api-hfx`
- **OR** `lt --port 80 --local-host dev.api.hfx.local --subdomain api-hfx` - Single command
- Static HTML -> Reverse proxy -> *https://api-hfx.loca.lt/* (Local development)