<?php


if(!defined('IS_LOCAL')) {
  define('IS_LOCAL', true); // Change to false in prod
}


$base_url = IS_LOCAL ? '/rubio' : '';
if(!defined('BASE_URL')) {
  define('BASE_URL', $base_url);
}