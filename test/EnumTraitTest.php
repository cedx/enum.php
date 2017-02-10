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
    $this->assertTrue($constructor->isFinal());
    $this->assertTrue($constructor->isPrivate());
  }

  /**
   * @test ::isDefined
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
   * @test ::getName
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
   * @test ::getNames
   */
  public function testGetNames() {
    $this->assertEquals(['ZERO', 'ONE', 'TWO', 'THREE'], SampleEnum::getNames());
  }

  /**
   * @test ::getValues
   */
  public function testGetValues() {
    $this->assertEquals([false, 1, 'two', 3.0], SampleEnum::getValues());
  }
}
