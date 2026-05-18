<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class BioPage extends Composer
{
    protected static $views = [
        'front-page',
        'page-bio',
        'partials.bio-page',
    ];

    public function with(): array
    {
        return [
            'name' => $this->name(),
            'pageTitle' => get_the_title(),
            'currentPage' => 'about',
            'role' => $this->field('bio_role'),
            'location' => $this->field('bio_location'),
            'bio' => $this->bioContent(),
            'avatar' => $this->field('bio_avatar'),
            'available' => (bool) $this->field('bio_available'),
            'skills' => $this->field('bio_skills'),
            'socials' => $this->field('bio_socials'),
            'email' => $this->field('bio_email'),
        ];
    }

    protected function name(): string
    {
        return $this->field('bio_name') ?: get_bloginfo('name');
    }

    protected function bioContent(): ?string
    {
        if ($text = $this->field('bio_text')) {
            return $text;
        }

        $post = get_queried_object();

        if (! $post instanceof \WP_Post || $post->post_type !== 'page') {
            return null;
        }

        $content = $post->post_content;

        if (! trim($content)) {
            return null;
        }

        return apply_filters('the_content', $content);
    }

    protected function field(string $key): mixed
    {
        if (! function_exists('get_field')) {
            return null;
        }

        return get_field($key);
    }
}
