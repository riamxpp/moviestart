<?php 
  
  $db_host = "localhost";
  $db_name = "moviestar";
  $db_user = "root";
  $db_pass = "";

  $conn = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host . ";charset=utf8mb4", $db_user, $db_pass);

  // Habilita erros PDO;
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);