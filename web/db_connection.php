<?php

function get_db_connection() {
  $host = 'mysql';
  $user = 'drupal';
  $pass = 'drupal';
  $database = 'rev_nginx_caching';

  return new MySQLi($host, $user, $pass, $database);
}
