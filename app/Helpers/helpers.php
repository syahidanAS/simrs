<?php

if (!function_exists('is_active')) {
    function is_active($routeNames)
    {
        if (is_array($routeNames)) {
            foreach ($routeNames as $routeName) {
                if (request()->routeIs($routeName)) {
                    return 'active';
                }
            }
            return '';
        }
        return request()->routeIs($routeNames) ? 'active' : '';
    }
}
