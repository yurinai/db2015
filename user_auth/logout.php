<?php
  if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
  }
  @session_destroy();
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: index.php");
  exit;            

?>
