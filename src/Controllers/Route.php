<?php

class Router
{
    private $request;
    private $pages;
    private $views;

    public function __construct($root)
    {
        $this->request = urldecode(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
        );
        $this->views = $root;
        $this->pages = $this->getPages($this->views);
    }

    /** ----------------------------
     *? Redirect URI
     * -----------------------------
     * Capture & clean URI to filter 
     *  through accepted pages.
     * 
     * @return string url
     */
    public function route()
    {
        // Get url var
        $uri = trim($this->request, "/");
        $uri = explode(".php", $uri);
        // $uri = explode("/", $uri[0]);

        // If var empty set to index
        empty($uri[0]) && $uri[0] = 'index';

        // Check for deep roots
        if (isset($uri[1])) {
            $uris = "";
            foreach ($uri as $i) {
                $uris .= $i . "/";
            }
            $uri[0] = substr($uris, 0, -1);
        }

        // Check if site exist
        if (in_array(strtolower($uri[0]), $this->pages)) {
            return '/' . $this->views . $uri[0] . '.php';
        } else {
            return '/' . $this->views . '404.php';
        }
    }

    /** ----------------------------
     *? Filter Pages
     * -----------------------------
     * Look through folders in 
     *  received path & build array 
     *  of pages to return.
     * 
     * @param string path to page directory
     * @return array pages
     */
    private function getPages($root)
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
                    if ($file !== "components" && $file !== "views") {
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

    /** ----------------------------
     *? Get Root
     * -----------------------------
     * Return clean document root
     *   as path.
     * 
     * @param boolean $returnName
     * @return string uri or name
     */
    public function getRoot()
    {
        return urldecode(
            parse_url($_SERVER['DOCUMENT_ROOT'], PHP_URL_PATH)
        );
    }

    /** ----------------------------
     *? Format URI
     * -----------------------------
     * Return clean uri as path OR
     *  as page name.
     * 
     * @param boolean $returnName
     * @return string uri or name
     */
    public function trimURI($returnName = false)
    {
        $page = explode(".php", $this->request);
        $page = explode("/", $page[0]);
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
        return $root = trim($root, "/");
    }

    /** ----------------------------
     *? Redirect to login
     * -----------------------------
     * If loggedIn session is false
     *  set intended URI as session
     *  & redirect to login page.
     * 
     * @return header login
     */
    public static function secure()
    {
        if (!$_SESSION['loggedIn']) {

            //  Get and clean current URI
            $_SESSION['uri'] = urldecode(
                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            );
            header("Location: login");
        }
    }

    /** ----------------------------
     *? Continue to intended url
     * -----------------------------
     * Capture URI session if set & 
     *  continue after login.
     * 
     * @return string url
     */
    public static function continue()
    {
        if (isset($_SESSION['uri'])) {
            $uri = $_SESSION['uri'];
            echo $uri;
        } else {
            echo "/";
        }
    }
}
