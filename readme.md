
# LaravelResponder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

A tiny Laravel package to format API responses.

## Installation

Via Composer

``` bash
$ composer require gaurav93d/laravelresponder
```

For Laravel version < 5.5, consider listing service provider and facade in `config/app.php`

``` php
'providers' => [
    ...
    gaurav93d\LaravelResponder\LaravelResponderServiceProvider::class,
    ...
],
'aliases' => [
    ...
    'Responder' => gaurav93d\LaravelResponder\Facades\Responder::class,
    ...
],
```  

## Usage

#### Response format

``` json
{
  "success": true,
  "status": 200,
  "data": [
    "Here your beautiful data goes"
  ],
  "errors": [
    "Here your ugly errors go"
  ]
}
```

#### Send success

``` php
...
use gaurav93d\LaravelResponder\Facades\Responder;
...

Responder::success($data  = [], $status = 200);
```

#### Send errors

``` php
...
use gaurav93d\LaravelResponder\Facades\Responder;
...

// Multiple errors
return Responder::errors($errors  = [], $status = 200);

// Single error
return Responder::error($message = 'Error!', $status = 200);

// Validation errors
return Responder::respondValidationErrors(Validator $validator);

// Here are some comman error responses 👇

// Internal server error
return Responder::respondInternalError($message = 'Internal Error!'); // status = 500

// Unauthorized error
return Responder::respondUnauthorizedError($message = 'Unauthorized!'); // status = 401

// Bad request error
return Responder::respondBadRequestError($message = 'Bad Request!'); // status = 400

// Not found error
return Responder::respondNotFoundError($message = 'Not found!'); // status = 404
```

#### Attach response headers

``` php
...
use gaurav93d\LaravelResponder\Facades\Responder;
...

return Responder::headers($headers = [])->success($data  = [], $status = 200);
...
return Responder::headers($headers = [])->errors($errors  = [], $status = 200);
...
```

... :wink: Stay tuned! More features to come.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Credits

- [Gaurav Deshpande](https://github.com/93gaurav93)
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/gaurav93d/laravelresponder.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/gaurav93d/laravelresponder.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/gaurav93d/laravelresponder/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/gaurav93d/laravelresponder
[link-downloads]: https://packagist.org/packages/gaurav93d/laravelresponder
[link-travis]: https://travis-ci.org/gaurav93d/laravelresponder
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/gaurav93d
[link-contributors]: ../../contributors
