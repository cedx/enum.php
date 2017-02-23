<?php
/**
 * Implementation of the `cedx\test\EnumTraitTest` class.
 */
namespace cedx\test;

use cedx\{EnumTrait};
use Codeception\{Specify};
use PHPUnit\Framework\{TestCase};

/**
 * A sample enumeration.
 */
final class SampleEnum {
  use EnumTrait;

  /**
   * @var bool The first enumerated value.
   */
  const ZERO = false;

  /**
   * @var int The second enumerated value.
   */
  const ONE = 1;

  /**
   * @var string The third enumerated value.
   */
  const TWO = 'two';

  /**
   * @var float The fourth enumerated value.
   */
  const THREE = 3.0;
}

/**
 * @coversDefaultClass \cedx\EnumTrait
 */
class EnumTraitTest extends TestCase {
  use Specify;

  /**
   * @test ::__construct
   */
  public function testConstructor() {
    $this->specify('should create types that are not instantiable', function() {
      $constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor();
      $this->assertTrue($constructor->isFinal());
      $this->assertTrue($constructor->isPrivate());
    });
  }

  /**
   * @test ::isDefined
   */
  public function testIsDefined() {
    $this->specify('should return `false` for unknown values', function() {
      $this->assertFalse(SampleEnum::isDefined('TWO'));
      $this->assertFalse(SampleEnum::isDefined(3.1));
    });

    $this->specify('should return `true` for known values', function() {
      $this->assertTrue(SampleEnum::isDefined(false));
      $this->assertTrue(SampleEnum::isDefined(1));
      $this->assertTrue(SampleEnum::isDefined('two'));
      $this->assertTrue(SampleEnum::isDefined(3.0));
    });

    $this->specify('should return `false` for similar values in strict mode', function() {
      $this->assertFalse(SampleEnum::isDefined('', true));
      $this->assertFalse(SampleEnum::isDefined(1.0, true));
      $this->assertFalse(SampleEnum::isDefined(3, true));
    });
  }

  /**
   * @test ::getName
   */
  public function testGetName() {
    $this->specify('should return an empty string for unknown values', function() {
      $this->assertEquals('', SampleEnum::getName('TWO'));
      $this->assertEquals('', SampleEnum::getName(3.1));
    });

    $this->specify('should return the name for known values', function() {
      $this->assertEquals('ZERO', SampleEnum::getName(false));
      $this->assertEquals('ONE', SampleEnum::getName(1));
      $this->assertEquals('TWO', SampleEnum::getName('two'));
      $this->assertEquals('THREE', SampleEnum::getName(3.0));
    });

    $this->specify('should return an empty string for similar values in strict mode', function() {
      $this->assertEquals('', SampleEnum::getName(0, true));
      $this->assertEquals('', SampleEnum::getName(1.0, true));
      $this->assertEquals('', SampleEnum::getName(3, true));
    });
  }

  /**
   * @test ::getNames
   */
  public function testGetNames() {
    $this->specify('should return the names of the enumerable properties', function() {
      $this->assertEquals(['ZERO', 'ONE', 'TWO', 'THREE'], SampleEnum::getNames());
    });
  }

  /**
   * @test ::getValues
   */
  public function testGetValues() {
    $this->specify('should return the values of the enumerable properties', function() {
      $this->assertEquals([false, 1, 'two', 3.0], SampleEnum::getValues());
    });
  }
}
