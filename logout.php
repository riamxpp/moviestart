<?php   

  require_once("templates/Header.php");

  if ($userDAO) {
    $userDAO->destroyToken();
  }