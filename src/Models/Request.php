<?php

class Request
{

    public static function redirect($page)
    {
        $page === "/" && $page = "";
        header("Location: /${page}");
    }

    /** ----------------------------
     *? Get GET query
     * -----------------------------
     * Get & clean query
     * 
     * @return string $query
     */
    public static function get($query)
    {
        if (isset($_GET[$query])) {
            return htmlspecialchars($_GET[$query]);
        } else {
            return '';
        }
    }

    /** ----------------------------
     *? Get POST query
     * -----------------------------
     * Get & clean query
     * 
     * @return string $query
     */
    public static function post($query)
    {
        if (isset($_POST[$query])) {
            return htmlspecialchars($_POST[$query]);
        } else {
            return '';
        }
    }

    /** ----------------------------
     *? Get All POST query
     * -----------------------------
     * Get & clean all post data
     * 
     * @return array $query
     */
    public static function postAll()
    {
        if (isset($_POST)) {
            foreach ($_POST as $key => $value) {
                $form[htmlspecialchars($key)] = htmlspecialchars($value);
            }
            return $form;
        } else {
            return '';
        }
    }

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
