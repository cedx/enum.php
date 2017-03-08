<?php
namespace cedx;
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
 * Tests the features of the `cedx\Enum` trait.
 */
class EnumTest extends TestCase {

  /**
   * @test Enum::__construct
   */
  public function testConstructor() {
    // It should create types that are not instantiable.
    $constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor();
    assertThat($constructor->isFinal(), isTrue());
    assertThat($constructor->isPrivate(), isTrue());
  }

  /**
   * @test Enum::isDefined
   */
  public function testIsDefined() {
    // It should return `false` for unknown values.
    assertThat(SampleEnum::isDefined('TWO'), isFalse());
    assertThat(SampleEnum::isDefined(3.1), isFalse());

    // It should return `true` for known values.
    assertThat(SampleEnum::isDefined(false), isTrue());
    assertThat(SampleEnum::isDefined(1), isTrue());
    assertThat(SampleEnum::isDefined('two'), isTrue());
    assertThat(SampleEnum::isDefined(3.0), isTrue());

    // It should return `false` for similar values in strict mode.
    assertThat(SampleEnum::isDefined('', true), isFalse());
    assertThat(SampleEnum::isDefined(1.0, true), isFalse());
    assertThat(SampleEnum::isDefined(3, true), isFalse());
  }

  /**
   * @test Enum::getName
   */
  public function testGetName() {
    // It should return an empty string for unknown values.
    assertThat(SampleEnum::getName('TWO'), isEmpty());
    assertThat(SampleEnum::getName(3.1), isEmpty());

    // It should return the name for known values.
    assertThat(SampleEnum::getName(false), equalTo('ZERO'));
    assertThat(SampleEnum::getName(1), equalTo('ONE'));
    assertThat(SampleEnum::getName('two'), equalTo('TWO'));
    assertThat(SampleEnum::getName(3.0), equalTo('THREE'));

    // It should return an empty string for similar values in strict mode.
    assertThat(SampleEnum::getName(0, true), isEmpty());
    assertThat(SampleEnum::getName(1.0, true), isEmpty());
    assertThat(SampleEnum::getName(3, true), isEmpty());
  }

  /**
   * @test Enum::getNames
   */
  public function testGetNames() {
    // It should return the names of the enumerable properties.
    assertThat(SampleEnum::getNames(), equalTo(['ZERO', 'ONE', 'TWO', 'THREE']));
  }

  /**
   * @test Enum::getValues
   */
  public function testGetValues() {
    // It should return the values of the enumerable properties.
    assertThat(SampleEnum::getValues(), equalTo([false, 1, 'two', 3.0]));
  }
}
