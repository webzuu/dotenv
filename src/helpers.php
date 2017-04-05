<?php

use Zuu\Dotenv\Dotenv;

if (!function_exists('env')) {

  function env($id) {
    return Dotenv::env($id);
  }

}

if (!function_exists('env_absolute')) {

  function env_absolute($key) {
    return Dotenv::env_absolute($key);
  }

}