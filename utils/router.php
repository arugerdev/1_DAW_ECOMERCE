<?php

function get_current_url()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return rtrim($uri, '/') ?: '/';
}

function is_admin_route()
{
    return str_starts_with(get_current_url(), '/admin');
}

function get_admin_route()
{
    $path = str_replace('/admin', '', get_current_url());
    return $path === '' ? '/' : $path;
}
