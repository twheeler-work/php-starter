<?php

class Utilities
{

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
