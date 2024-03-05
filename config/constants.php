<?php


if(!defined('IS_LOCAL')) {
  define('IS_LOCAL', false); // Change to false in prod
}

$base_url = IS_LOCAL ? '/rubio' : '';
if(!defined('BASE_URL')) {
  define('BASE_URL', $base_url);
}

if(!defined('CONTACT_PHONE')) {
  define('CONTACT_PHONE', '+234 4523649150');
}