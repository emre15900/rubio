<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'constants.php';

if(IS_LOCAL) {
  $dbname = 'rubio';
  $user = 'root';
  $password = 'markomeje';
}else {
  $dbname = 'fastcheckout_db';
  $user = 'fstchkout_user';
  $password = '84^7uo3Qf';
}

$host = IS_LOCAL ? '127.0.0.1' : 'localhost';
$dsn = 'mysql:host='.$host.';dbname='.$dbname;