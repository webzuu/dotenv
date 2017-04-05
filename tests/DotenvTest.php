<?php
namespace Zuu\Dotenv;

use PHPUnit\Framework\TestCase;

class DotenvTest extends TestCase
{
  protected function dotenv()
  {
    return new Dotenv(__DIR__ . '/fixtures/child');
  }

  /** @test **/
  public function it_can_be_instantiated()
  {
    $dotenv = new Dotenv(__DIR__);
    $this->assertInstanceOf(Dotenv::class, $dotenv);
  }

  /** @test **/
  public function it_loads_env_variables_including_parent_dirs()
  {
    $this->dotenv()->load();

    $this->assertEquals('foo', env('CHILD_VAR'));
    $this->assertEquals('foo', env('PARENT_VAR'));
    $this->assertEquals('baz', env('GLOBAL_VAR'));
  }

  /** @test **/
  public function it_creates_variables_origin_path_map()
  {
    $dotenv = $this->dotenv();
    $dotenv->load();

    $this->assertEquals(__DIR__.'/fixtures/child', $dotenv::$map['CHILD_VAR']);
    $this->assertEquals(__DIR__.'/fixtures', $dotenv::$map['GLOBAL_VAR']);
    $this->assertEquals(__DIR__.'/fixtures', $dotenv::$map['PARENT_VAR']);
  }

  /** @test **/
  public function helper_platform_path_returns_absolutized_path()
  {
    $dotenv = $this->dotenv();
    $dotenv->load();

    $this->assertEquals(__DIR__.'/fixtures/child/path', platform_path('CHILD_PATH'));
    $this->assertEquals(__DIR__.'/fixtures/path', platform_path('PARENT_PATH'));
  }
}