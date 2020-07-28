<?php

class Helper
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
     *? Get file extension
     * -----------------------------
     * Return file extension
     * 
     * @return string $file file name
     */
    public static function getExt($file)
    {
        if (!empty($file) || $file !== '') {
            return pathinfo($file, PATHINFO_EXTENSION);
        }
    }

    /** ----------------------------
     *? Return JSON error message
     * -----------------------------
     * @param string $text optional
     * @return JSON error message
     */
    public static function jsonError($text = false)
    {
        !$text = "Something went wrong!";
        $message = [
            'title' => "Oops",
            'text' =>  $text,
            'type' =>  "error",
        ];
        echo json_encode($message);
        exit();
    }
}
