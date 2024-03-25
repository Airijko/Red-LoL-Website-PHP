 <?php

  require __DIR__ . '/../vendor/autoload.php';

  use Dotenv\Dotenv;

  $dotenv = Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  $ADMIN_LOGIN = $_ENV['ADMIN_LOGIN'];
  $ADMIN_PASSWORD = $_ENV['ADMIN_PASS'];
  define('ADMIN_LOGIN', $ADMIN_LOGIN);
  define('ADMIN_PASSWORD', $ADMIN_PASSWORD);

  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])

      || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)

      || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) {

    header('HTTP/1.1 401 Unauthorized');

    header('WWW-Authenticate: Basic realm="Our Blog"');

    exit("Access Denied: Username and password required.");

  }

?>