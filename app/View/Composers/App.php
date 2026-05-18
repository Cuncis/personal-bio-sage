<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Retrieve the site name.
     */
    public function siteName(): string
    {
        return get_bloginfo('name', 'display');
    }

    public function name(): string
    {
        return get_bloginfo('name', 'display');
    }

    public function currentPage(): string
    {
        return '';
    }

    public function pageTitle(): string
    {
        return wp_get_document_title();
    }
}
