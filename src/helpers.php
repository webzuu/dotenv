<?php

use Zuu\Dotenv\Dotenv;

if (!function_exists('env')) {

  function env($id) {
    return Dotenv::env($id);
  }

}

if (!function_exists('platform_path')) {

  function platform_path($key) {
    return Dotenv::platform_path($key);
  }

}