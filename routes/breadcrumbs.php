<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/**
 * Home
 */
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

/**
 * Home > [Post]
 */
Breadcrumbs::for('post', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('home')->push($post->title, route('post.show', $post));
});
