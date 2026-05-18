<?php

use App\Providers\ThemeServiceProvider;
use Roots\Acorn\Application;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code> from the theme directory (or <code>bin/setup</code>).', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Ensure Acorn cache directories exist (writable by the web server)
|--------------------------------------------------------------------------
|
| Sage/Acorn stores compiled views and package manifests under
| wp-content/cache/acorn. Apache/php-fpm often cannot create these on first
| boot if wp-content is owned by another user.
|
*/

if (defined('WP_CONTENT_DIR')) {
    $acornCache = WP_CONTENT_DIR.'/cache/acorn';

    foreach ([
        'framework/cache/data',
        'framework/views',
        'framework/sessions',
        'logs',
    ] as $directory) {
        if (! is_dir("{$acornCache}/{$directory}")) {
            wp_mkdir_p("{$acornCache}/{$directory}");
        }
    }
}

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

Application::configure()
    ->withProviders([
        ThemeServiceProvider::class,
    ])
    ->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });
