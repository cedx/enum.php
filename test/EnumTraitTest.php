<?php declare(strict_types=1);
namespace Enum;

use function PHPUnit\Expect\{expect, it};
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

/** @testdox Enum\EnumTrait */
class EnumTraitTest extends TestCase {

  /** @testdox constructor */
  function testConstructor(): void {
    it('should create types that are not instantiable', function() {
      if ($constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor()) {
        expect($constructor->isFinal())->to->be->true;
        expect($constructor->isPrivate())->to->be->true;
      }
    });
  }

  /** @testdox ::assert() */
  function testAssert(): void {
    it('should return the specified value if it is a known one', function() {
      expect(SampleEnum::assert(false))->to->equal(SampleEnum::zero);
      expect(SampleEnum::assert(1))->to->equal(SampleEnum::one);
      expect(SampleEnum::assert('TWO'))->to->equal(SampleEnum::two);
      expect(SampleEnum::assert(3.0))->to->equal(SampleEnum::three);
    });

    it('should throw an exception if it is an unknown value', function() {
      expect(fn() => SampleEnum::assert(''))->to->throw(\UnexpectedValueException::class);
    });
  }

  /** @testdox ::coerce() */
  function testCoerce(): void {
    it('should return the specified value if it is a known one', function() {
      expect(SampleEnum::coerce(false))->to->equal(SampleEnum::zero);
      expect(SampleEnum::coerce(1))->to->equal(SampleEnum::one);
      expect(SampleEnum::coerce('TWO'))->to->equal(SampleEnum::two);
      expect(SampleEnum::coerce(3.0))->to->equal(SampleEnum::three);
    });

    it('should return the default value if it is an unknown one', function() {
      expect(SampleEnum::coerce(''))->to->be->null;
      expect(SampleEnum::coerce(1.0))->to->be->null;
      expect(SampleEnum::coerce('two', SampleEnum::zero))->to->equal(SampleEnum::zero);
      expect(SampleEnum::coerce(3.1, SampleEnum::two))->to->equal(SampleEnum::two);
    });
  }

  /** @testdox ::isDefined() */
  function testIsDefined(): void {
    it('should return `false` for unknown values', function() {
      expect(SampleEnum::isDefined(''))->to->be->false;
      expect(SampleEnum::isDefined(1.0))->to->be->false;
      expect(SampleEnum::isDefined('two'))->to->be->false;
      expect(SampleEnum::isDefined(3.1))->to->be->false;
    });

    it('should return `true` for known values', function() {
      expect(SampleEnum::isDefined(false))->to->be->true;
      expect(SampleEnum::isDefined(1))->to->be->true;
      expect(SampleEnum::isDefined('TWO'))->to->be->true;
      expect(SampleEnum::isDefined(3.0))->to->be->true;
    });
  }

  /** @testdox ::getEntries() */
  function testGetEntries(): void {
    it('should return the pairs of names and values of the enumerated constants', function() {
      expect(SampleEnum::getEntries())->to->equal(['zero' => false, 'one' => 1, 'two' => 'TWO', 'three' => 3.0]);
    });
  }

  /** @testdox ::getIndex() */
  function testGetIndex(): void {
    it('should return `-1` for unknown values', function() {
      expect(SampleEnum::getIndex(0))->to->equal(-1);
      expect(SampleEnum::getIndex(1.0))->to->equal(-1);
      expect(SampleEnum::getIndex('two'))->to->equal(-1);
      expect(SampleEnum::getIndex(3.1))->to->equal(-1);
    });

    it('should return the index of the enumerated constant for known values', function() {
      expect(SampleEnum::getIndex(false))->to->equal(0);
      expect(SampleEnum::getIndex(1))->to->equal(1);
      expect(SampleEnum::getIndex('TWO'))->to->equal(2);
      expect(SampleEnum::getIndex(3.0))->to->equal(3);
    });
  }

  /** @testdox ::getName() */
  function testGetName(): void {
    it('should return an empty string for unknown values', function() {
      expect(SampleEnum::getName(0))->to->be->empty;
      expect(SampleEnum::getName(1.0))->to->be->empty;
      expect(SampleEnum::getName('two'))->to->be->empty;
      expect(SampleEnum::getName(3.1))->to->be->empty;
    });

    it('should return the name for known values', function() {
      expect(SampleEnum::getName(false))->to->equal('zero');
      expect(SampleEnum::getName(1))->to->equal('one');
      expect(SampleEnum::getName('TWO'))->to->equal('two');
      expect(SampleEnum::getName(3.0))->to->equal('three');
    });
  }

  /** @testdox ::getNames() */
  function testGetNames(): void {
    it('should return the names of the enumerated constants', function() {
      expect(SampleEnum::getNames())->to->equal(['zero', 'one', 'two', 'three']);
    });
  }

  /** @testdox ::getValues() */
  function testGetValues(): void {
    it('should return the values of the enumerated constants', function() {
      expect(SampleEnum::getValues())->to->equal([false, 1, 'TWO', 3.0]);
    });
  }
}
