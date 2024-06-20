<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation

> Project using PHP 8.3 / SQLite

1. Run `composer install`.
2. Run `php artisan env:decrypt --key=FgfWDsCvz23oeZp75cVEpZfCxNMAwCJz`
3. Run `php artisan migrate:fresh --seed`
4. Run `php artisan serve`
5. Open `http://127.0.0.1:8000` in your browser

## API Routes

API Endpoint: `http://127.0.0.1:8000/api`

> Please add `Accept: application/json` header to all your requests

> Cart routes requires authentication, so please get token via "Login" route first

### Login

Method: `POST`

URL: `http://127.0.0.1:8000/api/login`

Payload:

```json 
{
    "email": "test@test.com",
    "password": "password"
}
```

Use `token` from response to all auth routes. Add header `Authorization: Bearer $token`

### Get Products

Method: `GET`

URL: `http://127.0.0.1:8000/api/products`

### Get Cart

Method: `GET`

URL: `http://127.0.0.1:8000/api/cart`

### Add items to cart

Method: `POST`

URL: `http://127.0.0.1:8000/api/cart-items`

Payload:

```json 
{
    "product_id": 1
}
```

### Delete Items from cart

Method: `DELETE`

URL: `http://127.0.0.1:8000/api/cart-items/{item_id}`

Where `item_id` is `items.*.id` from `Get Cart` request
