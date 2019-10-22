<?
session_start();
define('APP_NAME', 'Sistema');
define('SITE_URL', 'localhost/sistema/');

// if (!isset($_SESSION['CREATED'])) {
//      $_SESSION['CREATED'] = time();
//  } else if (time() - $_SESSION['CREATED'] > 1800) {
//      session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
//      $_SESSION['CREATED'] = time();  // update creation time
//  }


include 'conn.php';
global $accessAreas;

if (basename($_SERVER['PHP_SELF']) != 'requests.php') {
     if (isset($_SESSION['user']) and !$_SESSION['checked']) {

          $passUser = $_SESSION['user']['password'];
          $passBanco = CRUD::SELECT('', 'users', 'email=:email', array('email' => $_SESSION['user']['email']), '');

          if ($passUser == $passBanco[0]['password']) {
               $_SESSION['checked'] = true;
               header('Location:' . $_SERVER['REQUEST_URI']);
          } else {
               header('Location: login.php');
          }
     } else if (isset($_SESSION['user']) and $_SESSION['checked']) {
          if(basename($_SERVER['PHP_SELF']) == 'login.php')
               header('Location:dashboard.php');
          $_SESSION['timer'] = 15000;
          $_SESSION['user'] = CRUD::SELECT_ID('', 'users', $_SESSION['user']['id']);
          $accessAreas = explode(',', $_SESSION['user']['access_areas']);
     } else {
          if (basename($_SERVER['PHP_SELF']) != 'login.php')
               header('Location: login.php');
     }
}
