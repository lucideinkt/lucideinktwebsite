<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Some hosting environments disable the core PHP function highlight_file(),
// which Symfony's error renderer uses when displaying exceptions. If it's not
// available, provide a very small fallback so the error renderer doesn't blow
// up while trying to show source code.
if (!function_exists('highlight_file')) {
    function highlight_file(string $filename, bool $return = false)
    {
        $content = '';
        if (is_readable($filename)) {
            $content = htmlspecialchars((string) file_get_contents($filename), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }
        $html = '<pre style="white-space:pre-wrap;word-break:break-word;">' . $content . '</pre>';
        if ($return) {
            return $html;
        }
        echo $html;
        // Ensure a return value in all code paths to satisfy static analysis tools.
        return null;
    }
}

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
