<?php declare(strict_types=1);
namespace Enum;

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

  /**
   * @var mixed A protected enumerated value that should be ignored.
   */
  protected const PROTECTED_VALUE = null;

  /**
   * @var mixed A private enumerated value that should be ignored.
   */
  private const PRIVATE_VALUE = null;
}

/**
 * Tests the features of the `Enum\EnumTrait` trait.
 */
class EnumTraitTest extends TestCase {

  /**
   * Tests the `EnumTrait` constructor.
   * @test
   */
  function testConstructor(): void {
    // It should create types that are not instantiable.
    if ($constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor()) {
      assertThat($constructor->isFinal(), isTrue());
      assertThat($constructor->isPrivate(), isTrue());
    }
  }

  /**
   * Tests the `EnumTrait::assert()` method.
   * @test
   */
  function testAssert(): void {
    // It should return the specified value if it is a known one.
    assertThat(SampleEnum::assert(false), equalTo(SampleEnum::ZERO));
    assertThat(SampleEnum::assert(1), equalTo(SampleEnum::ONE));
    assertThat(SampleEnum::assert('two'), equalTo(SampleEnum::TWO));
    assertThat(SampleEnum::assert(3.0), equalTo(SampleEnum::THREE));

    // It should throw an exception if it is an unknown value.
    $this->expectException(\UnexpectedValueException::class);
    SampleEnum::assert('');
  }

  /**
   * Tests the `EnumTrait::coerce()` method.
   * @test
   */
  function testCoerce(): void {
    // It should return the specified value if it is a known one.
    assertThat(SampleEnum::coerce(false), equalTo(SampleEnum::ZERO));
    assertThat(SampleEnum::coerce(1), equalTo(SampleEnum::ONE));
    assertThat(SampleEnum::coerce('two'), equalTo(SampleEnum::TWO));
    assertThat(SampleEnum::coerce(3.0), equalTo(SampleEnum::THREE));

    // It should return the default value if it is an unknown one.
    assertThat(SampleEnum::coerce(''), isNull());
    assertThat(SampleEnum::coerce(1.0), isNull());
    assertThat(SampleEnum::coerce('TWO', SampleEnum::ZERO), equalTo(SampleEnum::ZERO));
    assertThat(SampleEnum::coerce(3.1, SampleEnum::TWO), equalTo(SampleEnum::TWO));
  }

  /**
   * Tests the `EnumTrait::isDefined()` method.
   * @test
   */
  function testIsDefined(): void {
    // It should return `false` for unknown values.
    assertThat(SampleEnum::isDefined(''), isFalse());
    assertThat(SampleEnum::isDefined(1.0), isFalse());
    assertThat(SampleEnum::isDefined('TWO'), isFalse());
    assertThat(SampleEnum::isDefined(3.1), isFalse());

    // It should return `true` for known values.
    assertThat(SampleEnum::isDefined(false), isTrue());
    assertThat(SampleEnum::isDefined(1), isTrue());
    assertThat(SampleEnum::isDefined('two'), isTrue());
    assertThat(SampleEnum::isDefined(3.0), isTrue());
  }

  /**
   * Tests the `EnumTrait::getEntries()` method.
   * @test
   */
  function testGetEntries(): void {
    // It should return the pairs of names and values of the enumerated constants.
    assertThat(SampleEnum::getEntries(), equalTo(['ZERO' => false, 'ONE' => 1, 'TWO' => 'two', 'THREE' => 3.0]));
  }

  /**
   * Tests the `EnumTrait::getIndex()` method.
   * @test
   */
  function testGetIndex(): void {
    // It should return `-1` for unknown values.
    assertThat(SampleEnum::getIndex(0), equalTo(-1));
    assertThat(SampleEnum::getIndex(1.0), equalTo(-1));
    assertThat(SampleEnum::getIndex('TWO'), equalTo(-1));
    assertThat(SampleEnum::getIndex(3.1), equalTo(-1));

    // It should return the index of the enumerated constant for known values.
    assertThat(SampleEnum::getIndex(false), equalTo(0));
    assertThat(SampleEnum::getIndex(1), equalTo(1));
    assertThat(SampleEnum::getIndex('two'), equalTo(2));
    assertThat(SampleEnum::getIndex(3.0), equalTo(3));
  }

  /**
   * Tests the `EnumTrait::getName()` method.
   * @test
   */
  function testGetName(): void {
    // It should return an empty string for unknown values.
    assertThat(SampleEnum::getName(0), isEmpty());
    assertThat(SampleEnum::getName(1.0), isEmpty());
    assertThat(SampleEnum::getName('TWO'), isEmpty());
    assertThat(SampleEnum::getName(3.1), isEmpty());

    // It should return the name for known values.
    assertThat(SampleEnum::getName(false), equalTo('ZERO'));
    assertThat(SampleEnum::getName(1), equalTo('ONE'));
    assertThat(SampleEnum::getName('two'), equalTo('TWO'));
    assertThat(SampleEnum::getName(3.0), equalTo('THREE'));
  }

  /**
   * Tests the `EnumTrait::getNames()` method.
   * @test
   */
  function testGetNames(): void {
    // It should return the names of the enumerated constants.
    assertThat(SampleEnum::getNames(), equalTo(['ZERO', 'ONE', 'TWO', 'THREE']));
  }

  /**
   * Tests the `EnumTrait::getValues()` method.
   * @test
   */
  function testGetValues(): void {
    // It should return the values of the enumerated constants.
    assertThat(SampleEnum::getValues(), equalTo([false, 1, 'two', 3.0]));
  }
}
