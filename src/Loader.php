<?php

namespace Zuu\Dotenv;

use Dotenv\Loader as BaseLoader;

class Loader extends BaseLoader
{
  public function read()
  {
    $this->ensureFileIsReadable();
    $filePath = $this->filePath;
    $lines = $this->readLinesFromFile($filePath);
    foreach ($lines as $line) {
        if (!$this->isComment($line) && $this->looksLikeSetter($line)) {
            list($name, $value) = $this->normaliseEnvironmentVariable($line, null);
            $variables[$name] = $value;
        }
    }
    return $variables;
  }
}