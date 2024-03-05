<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include ('config/constants.php');
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}

$user = empty($_SESSION['user']) ? false : $_SESSION['user'];

?>