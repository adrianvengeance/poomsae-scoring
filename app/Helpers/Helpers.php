<?php

if (! function_exists('nameShowing')) {

  function nameShowing($string)
  {
    $name = explode(' ', $string);
    return $name[0] . ' ' . $name[1];
  }
}
