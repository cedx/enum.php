<?php
declare(strict_types=1);
namespace Enum;

use function PHPUnit\Expect\{expect, it};
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
 * Tests the features of the `Enum\EnumTrait` trait.
 */
class EnumTraitTest extends TestCase {

  /**
   * @test EnumTrait::__construct
   */
  public function testConstructor() {
    it('should create types that are not instantiable', function() {
      $constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor();
      expect($constructor->isFinal())->to->be->true;
      expect($constructor->isPrivate())->to->be->true;
    });
  }

  /**
  /**
   * @test EnumTrait::coerce
   */
  public function testCoerce() {
    // TODO
  }

  /**
   * @test EnumTrait::isDefined
   */
  public function testIsDefined() {
    it('should return `false` for unknown values', function() {
      expect(SampleEnum::isDefined(''))->to->be->false;
      expect(SampleEnum::isDefined(1.0))->to->be->false;
      expect(SampleEnum::isDefined('TWO'))->to->be->false;
      expect(SampleEnum::isDefined(3.1))->to->be->false;
    });

    it('should return `true` for known values', function() {
      expect(SampleEnum::isDefined(false))->to->be->true;
      expect(SampleEnum::isDefined(1))->to->be->true;
      expect(SampleEnum::isDefined('two'))->to->be->true;
      expect(SampleEnum::isDefined(3.0))->to->be->true;
    });
  }

  /**
   * @test EnumTrait::getEntries
   */
  public function testGetEntries() {
    it('should return the names of the enumerated constants', function() {
      expect(SampleEnum::getEntries())->to->equal(['ZERO' => false, 'ONE' => 1, 'TWO' => 'two', 'THREE' => 3.0]);
    });
  }

  /**
   * @test EnumTrait::getIndex
   */
  public function testGetIndex() {
    it('should return `-1` for unknown values', function() {
      expect(SampleEnum::getIndex(0))->to->equal(-1);
      expect(SampleEnum::getIndex(1.0))->to->equal(-1);
      expect(SampleEnum::getIndex('TWO'))->to->equal(-1);
      expect(SampleEnum::getIndex(3.1))->to->equal(-1);
    });

    it('should return the enumerated constant for known values', function() {
      expect(SampleEnum::getIndex(false))->to->equal(0);
      expect(SampleEnum::getIndex(1))->to->equal(1);
      expect(SampleEnum::getIndex('two'))->to->equal(2);
      expect(SampleEnum::getIndex(3.0))->to->equal(3);
    });
  }

  /**
   * @test EnumTrait::getName
   */
  public function testGetName() {
    it('should return an empty string for unknown values', function() {
      expect(SampleEnum::getName(0))->to->be->empty;
      expect(SampleEnum::getName(1.0))->to->be->empty;
      expect(SampleEnum::getName('TWO'))->to->be->empty;
      expect(SampleEnum::getName(3.1))->to->be->empty;
    });

    it('should return the name for known values', function() {
      expect(SampleEnum::getName(false))->to->equal('ZERO');
      expect(SampleEnum::getName(1))->to->equal('ONE');
      expect(SampleEnum::getName('two'))->to->equal('TWO');
      expect(SampleEnum::getName(3.0))->to->equal('THREE');
    });
  }

  /**
   * @test EnumTrait::getNames
   */
  public function testGetNames() {
    it('should return the names of the enumerated constants', function() {
      expect(SampleEnum::getNames())->to->equal(['ZERO', 'ONE', 'TWO', 'THREE']);
    });
  }

  /**
   * @test EnumTrait::getValues
   */
  public function testGetValues() {
    it('should return the values of the enumerated constants', function() {
      expect(SampleEnum::getValues())->to->equal([false, 1, 'two', 3.0]);
    });
  }
}
