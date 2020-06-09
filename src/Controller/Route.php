<?php

class Router
{
    private $request;
    private $pages;

    public $views;

    public function __construct($request, $pages)
    {
        $this->request = $request;
        $this->pages = $pages;
    }

    public function redirect()
    {
        // Get url var
        $uri = trim($this->request, "/");
        $uri = explode("/", $uri);

        // If var empty set to index
        empty($uri[0]) && $uri[0] = 'index';

        // Split query value
        $query = explode(".php?", $uri[0]);

        // Check for deep roots
        if (isset($uri[1])) {
            $uris = "";
            foreach ($uri as $i) {
                $uris .= $i . "/";
            }
            $uri[0] = substr($uris, 0, -1);
        }

        // Check for query
        if (!empty($query[1])) {
            $uri[0] = $query[0];
        }

        // Check if site exist
        if (in_array($uri[0], $this->pages)) {
            return '/' . $this->views . $uri[0] . '.php';
        } else {
            return '/' . $this->views . '404.php';
        }
    }

    static function getPages($root)
    {
        $pages = array();
        $directories = array();
        $last_letter  = $root[strlen($root) - 1];
        $root  = ($last_letter == '\\' || $last_letter == '/') ? $root : $root . DIRECTORY_SEPARATOR;

        $directories[]  = $root;

        // Get multilevel pages
        while (sizeof($directories)) {
            $dir  = array_pop($directories);
            if ($handle = opendir($dir)) {
                while (false !== ($file = readdir($handle))) {
                    // Avoid these directories
                    if ($file == '.' || $file == '..') {
                        continue;
                    }
                    // Remove these directories
                    if ($file !== "components" && $file !== "pages") {
                        $file  = $dir . $file;
                        if (is_dir($file)) {
                            $directory_path = $file . DIRECTORY_SEPARATOR;
                            array_push($directories, $directory_path);
                        } elseif (is_file($file)) {

                            // Remove root
                            $file = str_replace($root, "", $file);
                            // Remove extension
                            $page = explode(".php", $file);
                            array_push($pages, $page[0]);
                        }
                    }
                }
                closedir($handle);
            }
        }
        return $pages;
    }

    static function trimURI($uri, $returnName = false)
    {
        $page = explode("/", $uri);
        $pageName = array_pop($page);
        $root = "";
        foreach ($page as $i) {
            $root .= $i . "/";
        }
        // Return page name
        if ($returnName) {
            empty($pageName) && $pageName = "index";
            $root = $pageName;
        }

        return $root = rtrim($root, "/");
    }
}
