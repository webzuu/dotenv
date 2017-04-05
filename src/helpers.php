<?php

if (!function_exists('env')) {

  function env($id) {
    return getenv($id);
  }

}