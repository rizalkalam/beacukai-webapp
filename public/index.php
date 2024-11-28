<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Installed
|--------------------------------------------------------------------------
|
| We check if the application is installed before we continue loading
| the application. This check helps to prevent loading the framework
| when the app is not installed or configured correctly.
|
*/

if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Turn On The Application
|--------------------------------------------------------------------------
|
| We load the Laravel application for handling incoming requests.
| We will create a new instance of the kernel and send the request.
|
*/

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Handle The Request
|--------------------------------------------------------------------------
|
| Here, we will pass the request to the Laravel application and send
| the response back to the browser. This is the main entry point
| for all requests to the application.
|
*/

// Check if the request is an API request
if (preg_match('/^\/api\//', $_SERVER['REQUEST_URI'])) {
    // Route to API controller for handling API requests
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    $response->send();
    $kernel->terminate($request, $response);
} else {
    // Handle standard web request
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    $response->send();
    $kernel->terminate($request, $response);
}
