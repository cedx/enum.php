<?php
namespace enum;
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
 * Tests the features of the `enum\EnumTrait` trait.
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
   * @test EnumTrait::isDefined
   */
  public function testIsDefined() {
    it('should return `false` for unknown values', function() {
      expect(SampleEnum::isDefined('TWO'))->to->be->false;
      expect(SampleEnum::isDefined(3.1))->to->be->false;
    });

    it('should return `true` for known values', function() {
      expect(SampleEnum::isDefined(false))->to->be->true;
      expect(SampleEnum::isDefined(1))->to->be->true;
      expect(SampleEnum::isDefined('two'))->to->be->true;
      expect(SampleEnum::isDefined(3.0))->to->be->true;
    });

    it('should return `false` for similar values in strict mode', function() {
      expect(SampleEnum::isDefined('', true))->to->be->false;
      expect(SampleEnum::isDefined(1.0, true))->to->be->false;
      expect(SampleEnum::isDefined(3, true))->to->be->false;
    });
  }

  /**
   * @test EnumTrait::getName
   */
  public function testGetName() {
    it('should return an empty string for unknown values', function() {
      expect(SampleEnum::getName('TWO'))->to->be->empty;
      expect(SampleEnum::getName(3.1))->to->be->empty;
    });

    it('should return the name for known values', function() {
      expect(SampleEnum::getName(false))->to->equal('ZERO');
      expect(SampleEnum::getName(1))->to->equal('ONE');
      expect(SampleEnum::getName('two'))->to->equal('TWO');
      expect(SampleEnum::getName(3.0))->to->equal('THREE');
    });

    it('should return an empty string for similar values in strict mode', function() {
      expect(SampleEnum::getName(0, true))->to->be->empty;
      expect(SampleEnum::getName(1.0, true))->to->be->empty;
      expect(SampleEnum::getName(3, true))->to->be->empty;
    });
  }

  /**
   * @test EnumTrait::getNames
   */
  public function testGetNames() {
    it('should return the names of the enumerable properties', function() {
      expect(SampleEnum::getNames())->to->equal(['ZERO', 'ONE', 'TWO', 'THREE']);
    });
  }

  /**
   * @test EnumTrait::getValues
   */
  public function testGetValues() {
    it('should return the values of the enumerable properties', function() {
      expect(SampleEnum::getValues())->to->equal([false, 1, 'two', 3.0]);
    });
  }
}
