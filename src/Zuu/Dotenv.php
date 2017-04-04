<?php
namespace Zuu;

use Dotenv\Dotenv as OriginalDotenv;

class Dotenv
{
  protected $directory;
  protected $file;

  public function __construct($directory, $file)
  {
    $this->directory = $directory;
    $this->file = $file;
  }

  public function load()
  {
    $dirs = explode(DIRECTORY_SEPARATOR, $this->directory);
    $dirs = array_filter($dirs);

    for($i = count($dirs); $i > 0; $i--) {
      $path = DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array_slice($dirs, 0, $i));
      $candidatePath = $path . DIRECTORY_SEPARATOR . $this->file;
      if (file_exists($candidatePath)) {
        $dotenv = new OriginalDotenv($path, $this->file);
        $dotenv->overload();
      }
    }
  }
}