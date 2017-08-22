<?php
declare(strict_types=1);
namespace Enum;

/**
 * Provides static methods for enumerations.
 */
trait EnumTrait {

  /**
   * Private constructor: prohibits the class instantiation.
   */
  final private function __construct() {}

  /**
   * Returns an indication whether a constant with a specified value exists in this enumeration.
   * @param mixed $value The value of a constant in this enumeration.
   * @param bool $strict Value indicating whether to perform a strict comparison.
   * @return bool `true` if a constant in this enumeration has the specified value, otherwise `false`.
   */
  public static function isDefined($value, bool $strict = true): bool {
    return in_array($value, static::getValues(), $strict);
  }

  /**
   * Returns the zero-based position of the constant in this enumeration that has the specified value.
   * @param mixed $value The value of a constant in this enumeration.
   * @param bool $strict Value indicating whether to perform a strict comparison.
   * @return int The zero-based position of the enumerated constant that has the specified value, or `-1` if no such constant is found.
   */
  public static function getIndex($value, bool $strict = true): int {
    $index = array_search($value, static::getValues(), $strict);
    return is_int($index) ? $index : -1;
  }

  /**
   * Retrieves the name of the constant in this enumeration that has the specified value.
   * @param mixed $value The value of a constant in this enumeration.
   * @param bool $strict Value indicating whether to perform a strict comparison.
   * @return string A string containing the name of the enumerated constant that has the specified value, or an empty string if no such constant is found.
   */
  public static function getName($value, bool $strict = true): string {
    $index = static::getIndex($value, $strict);
    return $index >= 0 ? static::getNames()[$index] : '';
  }

  /**
   * Retrieves an array of the names of the constants in this enumeration.
   * @return string[] An array that contains the names of the constants in this enumeration.
   */
  public static function getNames(): array {
    return array_keys(static::getConstants());
  }

  /**
   * Retrieves an array of the values of the constants in this enumeration.
   * @return array An array that contains the values of the constants in this enumeration.
   */
  public static function getValues(): array {
    return array_values(static::getConstants());
  }

  /**
   * Retrieves an array of the names and values of the constants in this enumeration.
   * @return array An array that contains the names and values of the constants in this enumeration.
   */
  private static function getConstants(): array {
    static $constants;
    if (!isset($constants)) $constants = (new \ReflectionClass(static::class))->getConstants();
    return $constants;
  }
}
