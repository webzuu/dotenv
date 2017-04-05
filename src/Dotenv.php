<?php
namespace Zuu\Dotenv;

use Dotenv\Dotenv as OriginalDotenv;

class Dotenv
{
  protected $directory;
  protected $file;

  public static $map = [];

  public function __construct($directory, $file = '.env')
  {
    $this->directory = $directory;
    $this->file = $file;
  }

  public static function env($id)
  {
    return getenv($id);
  }

  public static function env_absolute($key)
  {
    $envPath = static::env($key);

    if (!isset(static::$map[$key]))
      return false;

    $origin = static::$map[$key];
    return $origin . '/' . $envPath;
  }

  public function load()
  {
    $dirs = explode(DIRECTORY_SEPARATOR, $this->directory);
    $dirs = array_filter($dirs);

    for($i = count($dirs); $i > 0; $i--) {
      $path = DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array_slice($dirs, 0, $i));
      $candidatePath = $path . DIRECTORY_SEPARATOR . $this->file;
      if (file_exists($candidatePath)) {
        $this->map($candidatePath);
        $dotenv = new OriginalDotenv($path, $this->file);
        $dotenv->overload();
      }
    }
  }

  protected function map($file)
  {
    $variables = parse_ini_file($file);
    foreach($variables as $key => $value) {
      static::$map[$key] = pathinfo($file, PATHINFO_DIRNAME);
    }
  }
}