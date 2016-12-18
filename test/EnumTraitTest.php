<?php
/**
 * Implementation of the `cedx\test\EnumTraitTest` class.
 */
namespace cedx\test;
use cedx\{EnumTrait};

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
 * Tests the features of the `cedx\EnumTrait` trait.
 */
class EnumTraitTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tests the `EnumTrait` constructor.
   */
  public function testConstructor() {
    $constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor();
    $this->assertTrue($constructor->isFinal());
    $this->assertTrue($constructor->isPrivate());
  }

  /**
   * Tests the `EnumTrait::isDefined()` method.
   */
  public function testIsDefined() {
    $this->assertFalse(SampleEnum::isDefined('TWO'));
    $this->assertFalse(SampleEnum::isDefined(3.1));

    $this->assertTrue(SampleEnum::isDefined(false));
    $this->assertTrue(SampleEnum::isDefined(1));
    $this->assertTrue(SampleEnum::isDefined('two'));
    $this->assertTrue(SampleEnum::isDefined(3.0));

    $this->assertFalse(SampleEnum::isDefined('', true));
    $this->assertFalse(SampleEnum::isDefined(1.0, true));
    $this->assertFalse(SampleEnum::isDefined(3, true));
  }

  /**
   * Tests the `EnumTrait::getName()` method.
   */
  public function testGetName() {
    $this->assertEquals('', SampleEnum::getName('TWO'));
    $this->assertEquals('', SampleEnum::getName(3.1));

    $this->assertEquals('ZERO', SampleEnum::getName(false));
    $this->assertEquals('ONE', SampleEnum::getName(1));
    $this->assertEquals('TWO', SampleEnum::getName('two'));
    $this->assertEquals('THREE', SampleEnum::getName(3.0));

    $this->assertEquals('', SampleEnum::getName(0, true));
    $this->assertEquals('', SampleEnum::getName(1.0, true));
    $this->assertEquals('', SampleEnum::getName(3, true));
  }

  /**
   * Tests the `EnumTrait::getNames()` method.
   */
  public function testGetNames() {
    $this->assertEquals(['ZERO', 'ONE', 'TWO', 'THREE'], SampleEnum::getNames());
  }

  /**
   * Tests the `EnumTrait::getValues()` method.
   */
  public function testGetValues() {
    $this->assertEquals([false, 1, 'two', 3.0], SampleEnum::getValues());
  }
}
