# GIAEAuth

A simple way to authenticate users whithout being given their credentials. Intended to be hosted on the school's infrastructure, ideally on the same subdomain (if it is the case) as GIAE (giae.escola.pt/auth.php).
This way, users may be less apprehensive of submiting their credentials.

## How to use

GIAEAuth expects 3 **required** variables:

- app_name (The name of your app)
- tos_pp (A url to your terms of service and privacy policy)
- callback (The callback url, where the session token will be sent to as a GET request, `sessioncookie`)

Your url should look similar to this: `/auth.php?app_name=Aplicação de teste&tos_pp=https://app.pt/tos&callback=https://app.pt/auth_callback.php`

As you can see, your app, which may be hosted elsewhere, will never get the user input, but only the PHP session cookie.

### Auth flow:
![Auth flowchart](/img/auth%20flow.svg)

### Preview:
![Auth flowchart](/img/web.png)

## Dealing with the response

```
<?php

$giae = new \juoum\GiaeConnect\GiaeConnect({your domain});
$giae->session = $_GET['sessioncookie'];

// Good to go!
```

## Main project
Check [GIAEConnect](https://github.com/itsjuoum/GIAEConnect/)

## Dependencies
GIAEAuth depends on [GIAEConnect](https://github.com/itsjuoum/GIAEConnect/) and uses [Bootstrap](https://getbootstrap.com/)

## Contributions
I appreciate any improvements or enhancements you can bring to this project. If you have ideas, bug fixes, or new features to propose, please don't hesitate to submit a pull request. 

<hr>
Developed and tested on v5.0.56.5.