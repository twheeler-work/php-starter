<?php

class Request
{

    public static function getHost()
    {
        if (isset($_SERVER)) {
            return $_SERVER['HTTP_HOST'];
        } else {
            return null;
        }
    }

    public static function getPrevious()
    {
        if (isset($_SERVER)) {
            return $_SERVER['REQUEST_URI'];
        } else {
            return '/';
        }
    }
}
