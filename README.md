<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalación del Proyecto

Por favor sigue los siguiente pasos, ingresa a la consola del sistema.
- composer install
- Haz una copia del archivo .env.example y renombrala como .env o digita este comando
  cp .env.example .env
- php artisan key:generate, este comando nos permitirá generar una nueva API key
- Ejecutar las migraciones con php artisan migrate --seed

## Credenciales API - Pasarelas de Pago

Debes tener una cuenta activa o en su defecto registrarte en cada plataforma para poder acceder a las respectivas credenciales API.

Una vez, obtenidas dichas credenciales deber ir al archivo .env y pegarlas en las variables que corresponden a cada plataforma de pago.

### Plataformas de Pago
- Paypal
- Stripe
- MercadoPago
- PayU

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
