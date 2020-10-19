<?php

class Request
{
  public function handleRequest()
  {
    if ($_POST) {
      return true;
    } else {
      return false;
    }
  }

  /** ----------------------------
   ** Redirect browser
   * -----------------------------
   * @return string $query
   */
  public static function redirect($page, int $code = null)
  {
    try {
      $page === "/" && ($page = "");
      $code
        ? header("Location: /$page", true, $code)
        : header("Location: /$page");
    } catch (Exception $e) {
      Session::set('errors', [$e]);
    }
  }

  /** ----------------------------
   ** Get GET query
   * -----------------------------
   * Get & clean query
   * @return string $query
   */
  public static function get($query)
  {
    try {
      if (isset($_GET[$query])) {
        return htmlspecialchars($_GET[$query]);
      } else {
        return '';
      }
    } catch (Exception $e) {
      Session::set('errors', [$e]);
    }
  }

  /** ----------------------------
   ** Get POST query
   * -----------------------------
   * Get & clean query
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
   ** Get All GET queries
   * -----------------------------
   * Get & clean GET queries
   * @return array $form
   */
  public static function allGet()
  {
    try {
      $form = [];
      foreach ($_GET as $name => $value) {
        $form[htmlspecialchars($name)] = htmlspecialchars($value);
      }
      return $form;
    } catch (Exception $e) {
      Session::set('errors', [$e]);
    }
  }

  /** ----------------------------
   ** Get All POST queries
   * -----------------------------
   * Get & clean POST queries
   * @return array $form
   */
  public static function allPost()
  {
    try {
      $form = [];
      foreach ($_POST as $name => $value) {
        $form[htmlspecialchars($name)] = htmlspecialchars($value);
      }
      return $form;
    } catch (Exception $e) {
      Session::set('errors', [$e]);
    }
  }

  /** ----------------------------
   ** Return HTTP_HOST
   * -----------------------------
   * @return string host
   */
  public static function getHost()
  {
    if ($_SERVER['HTTP_HOST']) {
      return urldecode(parse_url($_SERVER['HTTP_HOST'], PHP_URL_PATH));
    } else {
      return null;
    }
  }

  /** ----------------------------
   ** Return REQUEST_URI
   * -----------------------------
   * @return string uri
   */
  public static function getURI()
  {
    if (isset($_SERVER['REQUEST_URI'])) {
      return urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    } else {
      return '/';
    }
  }

  /** ----------------------------
   ** Return HTTP_X_AUTH_TOKEN
   * -----------------------------
   * @return string token
   */
  public static function getXToken()
  {
    if (isset($_SERVER['HTTP_X_AUTH_TOKEN'])) {
      return urldecode(parse_url($_SERVER['HTTP_X_AUTH_TOKEN'], PHP_URL_PATH));
    } else {
      return null;
    }
  }

  /** ----------------------------
   ** Return HTTP_REFERER
   * -----------------------------
   * @return string referer
   */
  public static function getReferer()
  {
    if (isset($_SERVER['HTTP_REFERER'])) {
      return urldecode(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
    } else {
      return null;
    }
  }

  /** ----------------------------
   ** Return DOCUMENT_ROOT
   * -----------------------------
   * @return string root
   */
  public static function getRoot()
  {
    if (isset($_SERVER['DOCUMENT_ROOT'])) {
      return urldecode(parse_url($_SERVER['DOCUMENT_ROOT'], PHP_URL_PATH));
    } else {
      return null;
    }
  }

  /** ----------------------------
   ** Redirect to login
   * -----------------------------
   * If loggedIn session is false
   *  set intended URI as session
   *  & redirect to login page.
   *
   * @return header login
   */
  public static function secure()
  {
    Session::timeout();
    if (!empty(Session::get('loggedIn'))) {
      Session::logout(['success' => 'You have been successfully logged out.']);
    }
  }

  /** ----------------------------
   ** Continue to intended url
   * -----------------------------
   * Capture URI session if set &
   *  continue after login.
   *
   * @return string url
   */
  public static function continue()
  {
    if (!empty(Session::get('uri'))) {
      echo Session::get('uri');
    } else {
      echo "/";
    }
  }

  /** ---------------------------
   ** Verify CSRF Token
   * -----------------------------
   * Compare session token with
   *  post token.
   * @param POST csrf-token
   * @return bool
   */
  public static function verify_token($token = false)
  {
    !$token && ($token = self::post('csrf-token'));
    if (!empty(Session::get('auth_token')) && !empty($token)) {
      if (hash_equals(Session::get('auth_token'), $token)) {
        return true;
      }
    }
    return false;
  }

  /** ---------------------------
   ** Verify Header Token
   * -----------------------------
   * Compare session token with
   *  header token to
   *  validate ajax.
   *
   * @param HTTP header
   * @return bool
   */
  public static function verify_header()
  {
    if (self::getXToken() !== Session::get('auth_token')) {
      Session::logout(['errors' => 'Invalid token!'], 401);
    }
  }
}
