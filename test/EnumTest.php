<?php
/**
 * Implementation of the `cedx\test\EnumTest` class.
 */
namespace cedx\test;

use cedx\{Enum};
use Codeception\{Specify};
use PHPUnit\Framework\{TestCase};

/**
 * A sample enumeration.
 */
final class SampleEnum {
  use Enum;

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
 * @coversDefaultClass \cedx\Enum
 */
class EnumTest extends TestCase {
  use Specify;

  /**
   * @test ::__construct
   */
  public function testConstructor() {
    $this->specify('should create types that are not instantiable', function() {
      $constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor();
      static::assertTrue($constructor->isFinal());
      static::assertTrue($constructor->isPrivate());
    });
  }

  /**
   * @test ::isDefined
   */
  public function testIsDefined() {
    $this->specify('should return `false` for unknown values', function() {
      static::assertFalse(SampleEnum::isDefined('TWO'));
      static::assertFalse(SampleEnum::isDefined(3.1));
    });

    $this->specify('should return `true` for known values', function() {
      static::assertTrue(SampleEnum::isDefined(false));
      static::assertTrue(SampleEnum::isDefined(1));
      static::assertTrue(SampleEnum::isDefined('two'));
      static::assertTrue(SampleEnum::isDefined(3.0));
    });

    $this->specify('should return `false` for similar values in strict mode', function() {
      static::assertFalse(SampleEnum::isDefined('', true));
      static::assertFalse(SampleEnum::isDefined(1.0, true));
      static::assertFalse(SampleEnum::isDefined(3, true));
    });
  }

  /**
   * @test ::getName
   */
  public function testGetName() {
    $this->specify('should return an empty string for unknown values', function() {
      static::assertEquals('', SampleEnum::getName('TWO'));
      static::assertEquals('', SampleEnum::getName(3.1));
    });

    $this->specify('should return the name for known values', function() {
      static::assertEquals('ZERO', SampleEnum::getName(false));
      static::assertEquals('ONE', SampleEnum::getName(1));
      static::assertEquals('TWO', SampleEnum::getName('two'));
      static::assertEquals('THREE', SampleEnum::getName(3.0));
    });

    $this->specify('should return an empty string for similar values in strict mode', function() {
      static::assertEquals('', SampleEnum::getName(0, true));
      static::assertEquals('', SampleEnum::getName(1.0, true));
      static::assertEquals('', SampleEnum::getName(3, true));
    });
  }

  /**
   * @test ::getNames
   */
  public function testGetNames() {
    $this->specify('should return the names of the enumerable properties', function() {
      static::assertEquals(['ZERO', 'ONE', 'TWO', 'THREE'], SampleEnum::getNames());
    });
  }

  /**
   * @test ::getValues
   */
  public function testGetValues() {
    $this->specify('should return the values of the enumerable properties', function() {
      static::assertEquals([false, 1, 'two', 3.0], SampleEnum::getValues());
    });
  }
}
