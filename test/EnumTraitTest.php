<?php
/**
 * Implementation of the `cedx\test\EnumTraitTest` class.
 */
namespace cedx\test;
use cedx\{Enum};

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
 * Tests the features of the `cedx\EnumTrait` trait.
 */
class EnumTraitTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tests the `Enum` constructor.
   */
  public function testConstructor() {
    $constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor();
    $this->assertTrue($constructor->isFinal());
    $this->assertTrue($constructor->isPrivate());
  }

  /**
   * Tests the `Enum::isDefined()` method.
   */
  public function testIsDefined() {
    $this->assertFalse(SampleEnum::isDefined('TWO'));
    $this->assertFalse(SampleEnum::isDefined(3.1));

    $this->assertTrue(SampleEnum::isDefined(false));
    $this->assertTrue(SampleEnum::isDefined(1));
    $this->assertTrue(SampleEnum::isDefined('two'));
    $this->assertTrue(SampleEnum::isDefined(3.0));
  }

  /**
   * Tests the `Enum::getConstants()` method.
   */
  public function testGetConstants() {
    $this->assertEquals(['ZERO' => false, 'ONE' => 1, 'TWO' => 'two', 'THREE' => 3.0], SampleEnum::getConstants());
  }

  /**
   * Tests the `Enum::getName()` method.
   */
  public function testGetName() {
    $this->assertEquals(SampleEnum::getName('TWO'), '');
    $this->assertEquals(SampleEnum::getName(3.1), '');

    $this->assertEquals(SampleEnum::getName(false), 'ZERO');
    $this->assertEquals(SampleEnum::getName(1), 'ONE');
    $this->assertEquals(SampleEnum::getName('two'), 'TWO');
    $this->assertEquals(SampleEnum::getName(3.0), 'THREE');
  }

  /**
   * Tests the `Enum::getNames()` method.
   */
  public function testGetNames() {
    $this->assertEquals(['ZERO', 'ONE', 'TWO', 'THREE'], SampleEnum::getNames());
  }

  /**
   * Tests the `Enum::getValues()` method.
   */
  public function testGetValues() {
    $this->assertEquals([false, 1, 'two', 3.0], SampleEnum::getValues());
  }
}
