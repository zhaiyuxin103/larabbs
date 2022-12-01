<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (! function_exists('make_excerpt')) {
    function make_excerpt($value, $length = 200): string
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));

        return Str::limit($excerpt, $length);
    }
}

if (! function_exists('route_class')) {
    function route_class(): string
    {
        return Str::replace('.', '-', Route::currentRouteName());
    }
}
