<?php

if (!function_exists('watchtower')) {
    function watchtower($on = null)
    {
        if ($on) {
            return app()->make('watchtower')->on($on);
        } else {
            return app()->make('watchtower');
        }
    }
}