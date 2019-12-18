<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));
define('PC_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
//定义网站根路径(http://localhost/mixcall/)
define('APP_URL', "http://".$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')+1));
define('MODULE_PATH', PC_PATH.'modules'.DIRECTORY_SEPARATOR);
define('MODULE_URL', APP_URL.'modules'.DIRECTORY_SEPARATOR);

// 设置session过期时间
ini_set('session.gc_maxlifetime', 5400);
// ini_set('session.cookie_lifetime',0);

define('MIXIOT_ADMIN_VERSION', '2.0.2');
define('MIXIOT_ADMIN_ID', 'ADMIN');

define('STORAGE_PATH', PC_PATH.'storage'.DIRECTORY_SEPARATOR);
define('STORAGE_URL', APP_URL.'storage'.DIRECTORY_SEPARATOR);

define('ROUTE_M', 'Modules\Diag\Http\Controllers');

define('FIDIS_ROOT_PATH', __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR);
//加载自定义函数进行使用
require __DIR__.'/../app/Helper/functions.php';

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
