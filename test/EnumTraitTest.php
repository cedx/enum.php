<?php
/**
 * Implementation of the `cedx\test\EnumTraitTest` class.
 */
namespace cedx\test;

use cedx\{EnumTrait};
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

  /**
   * @test ::__construct
   */
  public function testConstructor() {
    $constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor();

    // Should create types that are not instantiable.
    $this->assertTrue($constructor->isFinal());
    $this->assertTrue($constructor->isPrivate());
  }

  /**
   * @test ::isDefined
   */
  public function testIsDefined() {
    // Should return `false` for unknown values.
    $this->assertFalse(SampleEnum::isDefined('TWO'));
    $this->assertFalse(SampleEnum::isDefined(3.1));

    // Should return `true` for known values.
    $this->assertTrue(SampleEnum::isDefined(false));
    $this->assertTrue(SampleEnum::isDefined(1));
    $this->assertTrue(SampleEnum::isDefined('two'));
    $this->assertTrue(SampleEnum::isDefined(3.0));

    // Should return `false` for similar values in strict mode.
    $this->assertFalse(SampleEnum::isDefined('', true));
    $this->assertFalse(SampleEnum::isDefined(1.0, true));
    $this->assertFalse(SampleEnum::isDefined(3, true));
  }

  /**
   * @test ::getName
   */
  public function testGetName() {
    // Should return an empty string for unknown values.
    $this->assertEquals('', SampleEnum::getName('TWO'));
    $this->assertEquals('', SampleEnum::getName(3.1));

    // Should return the name for known values.
    $this->assertEquals('ZERO', SampleEnum::getName(false));
    $this->assertEquals('ONE', SampleEnum::getName(1));
    $this->assertEquals('TWO', SampleEnum::getName('two'));
    $this->assertEquals('THREE', SampleEnum::getName(3.0));

    // Should return an empty string for similar values in strict mode.
    $this->assertEquals('', SampleEnum::getName(0, true));
    $this->assertEquals('', SampleEnum::getName(1.0, true));
    $this->assertEquals('', SampleEnum::getName(3, true));
  }

  /**
   * @test ::getNames
   */
  public function testGetNames() {
    // Should return the names of the enumerable properties.
    $this->assertEquals(['ZERO', 'ONE', 'TWO', 'THREE'], SampleEnum::getNames());
  }

  /**
   * @test ::getValues
   */
  public function testGetValues() {
    // Should return the values of the enumerable properties.
    $this->assertEquals([false, 1, 'two', 3.0], SampleEnum::getValues());
  }
}
