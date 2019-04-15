<?php declare(strict_types=1);
namespace Enum;

use PHPUnit\Framework\{TestCase};

/** A sample enumeration. */
final class SampleEnum {
  use EnumTrait;

  /** @var bool The first enumerated value. */
  const zero = false;

  /** @var int The second enumerated value. */
  const one = 1;

  /** @var string The third enumerated value. */
  const two = 'TWO';

  /** @var float The fourth enumerated value. */
  const three = 3.0;

  /** @var mixed A protected enumerated value that should be ignored. */
  protected const protectedValue = null;

  /** @var mixed A private enumerated value that should be ignored. */
  private const privateValue = null;
}

/** Tests the features of the `Enum\EnumTrait` trait. */
class EnumTraitTest extends TestCase {

  /** @test Tests the `EnumTrait` constructor. */
  function testConstructor(): void {
    // It should create types that are not instantiable.
    if ($constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor()) {
      assertThat($constructor->isFinal(), isTrue());
      assertThat($constructor->isPrivate(), isTrue());
    }
  }

  /** @test Tests the `EnumTrait::assert()` method. */
  function testAssert(): void {
    // It should return the specified value if it is a known one.
    assertThat(SampleEnum::assert(false), equalTo(SampleEnum::zero));
    assertThat(SampleEnum::assert(1), equalTo(SampleEnum::one));
    assertThat(SampleEnum::assert('TWO'), equalTo(SampleEnum::two));
    assertThat(SampleEnum::assert(3.0), equalTo(SampleEnum::three));

    // It should throw an exception if it is an unknown value.
    $this->expectException(\UnexpectedValueException::class);
    SampleEnum::assert('');
  }

  /** @test Tests the `EnumTrait::coerce()` method. */
  function testCoerce(): void {
    // It should return the specified value if it is a known one.
    assertThat(SampleEnum::coerce(false), equalTo(SampleEnum::zero));
    assertThat(SampleEnum::coerce(1), equalTo(SampleEnum::one));
    assertThat(SampleEnum::coerce('TWO'), equalTo(SampleEnum::two));
    assertThat(SampleEnum::coerce(3.0), equalTo(SampleEnum::three));

    // It should return the default value if it is an unknown one.
    assertThat(SampleEnum::coerce(''), isNull());
    assertThat(SampleEnum::coerce(1.0), isNull());
    assertThat(SampleEnum::coerce('two', SampleEnum::zero), equalTo(SampleEnum::zero));
    assertThat(SampleEnum::coerce(3.1, SampleEnum::two), equalTo(SampleEnum::two));
  }

  /** @test Tests the `EnumTrait::isDefined()` method. */
  function testIsDefined(): void {
    // It should return `false` for unknown values.
    assertThat(SampleEnum::isDefined(''), isFalse());
    assertThat(SampleEnum::isDefined(1.0), isFalse());
    assertThat(SampleEnum::isDefined('two'), isFalse());
    assertThat(SampleEnum::isDefined(3.1), isFalse());

    // It should return `true` for known values.
    assertThat(SampleEnum::isDefined(false), isTrue());
    assertThat(SampleEnum::isDefined(1), isTrue());
    assertThat(SampleEnum::isDefined('TWO'), isTrue());
    assertThat(SampleEnum::isDefined(3.0), isTrue());
  }

  /** @test Tests the `EnumTrait::getEntries()` method. */
  function testGetEntries(): void {
    // It should return the pairs of names and values of the enumerated constants.
    assertThat(SampleEnum::getEntries(), equalTo(['zero' => false, 'one' => 1, 'two' => 'TWO', 'three' => 3.0]));
  }

  /** @test Tests the `EnumTrait::getIndex()` method. */
  function testGetIndex(): void {
    // It should return `-1` for unknown values.
    assertThat(SampleEnum::getIndex(0), equalTo(-1));
    assertThat(SampleEnum::getIndex(1.0), equalTo(-1));
    assertThat(SampleEnum::getIndex('two'), equalTo(-1));
    assertThat(SampleEnum::getIndex(3.1), equalTo(-1));

    // It should return the index of the enumerated constant for known values.
    assertThat(SampleEnum::getIndex(false), equalTo(0));
    assertThat(SampleEnum::getIndex(1), equalTo(1));
    assertThat(SampleEnum::getIndex('TWO'), equalTo(2));
    assertThat(SampleEnum::getIndex(3.0), equalTo(3));
  }

  /** @test Tests the `EnumTrait::getName()` method. */
  function testGetName(): void {
    // It should return an empty string for unknown values.
    assertThat(SampleEnum::getName(0), isEmpty());
    assertThat(SampleEnum::getName(1.0), isEmpty());
    assertThat(SampleEnum::getName('two'), isEmpty());
    assertThat(SampleEnum::getName(3.1), isEmpty());

    // It should return the name for known values.
    assertThat(SampleEnum::getName(false), equalTo('zero'));
    assertThat(SampleEnum::getName(1), equalTo('one'));
    assertThat(SampleEnum::getName('TWO'), equalTo('two'));
    assertThat(SampleEnum::getName(3.0), equalTo('three'));
  }

  /** @test Tests the `EnumTrait::getNames()` method. */
  function testGetNames(): void {
    // It should return the names of the enumerated constants.
    assertThat(SampleEnum::getNames(), equalTo(['zero', 'one', 'two', 'three']));
  }

  /** @test Tests the `EnumTrait::getValues()` method. */
  function testGetValues(): void {
    // It should return the values of the enumerated constants.
    assertThat(SampleEnum::getValues(), equalTo([false, 1, 'TWO', 3.0]));
  }
}
