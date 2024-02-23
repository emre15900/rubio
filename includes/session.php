<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include ('config/constants.php');
session_start();

$user = empty($_SESSION['user']) ? false : $_SESSION['user'];

?>