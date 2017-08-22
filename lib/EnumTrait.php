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
   * @return bool `true` if a constant in this enumeration has the specified value, otherwise `false`.
   */
  public static function isDefined($value): bool {
    return in_array($value, static::getValues(), true);
  }

  /**
   * Retrieves an associative array of the names and values of the constants in this enumeration.
   * @return array An associative array that contains the names and values of the constants in this enumeration.
   */
  public static function getEntries(): array {
    static $entries;
    if (!isset($entries)) $entries = (new \ReflectionClass(static::class))->getConstants();
    return $entries;
  }

  /**
   * Returns the zero-based position of the constant in this enumeration that has the specified value.
   * @param mixed $value The value of a constant in this enumeration.
   * @return int The zero-based position of the enumerated constant that has the specified value, or `-1` if no such constant is found.
   */
  public static function getIndex($value): int {
    $index = array_search($value, static::getValues(), true);
    return $index !== false ? $index : -1;
  }

  /**
   * Retrieves the name of the constant in this enumeration that has the specified value.
   * @param mixed $value The value of a constant in this enumeration.
   * @return string A string containing the name of the enumerated constant that has the specified value, or an empty string if no such constant is found.
   */
  public static function getName($value): string {
    $index = static::getIndex($value);
    return $index >= 0 ? static::getNames()[$index] : '';
  }

  /**
   * Retrieves an array of the names of the constants in this enumeration.
   * @return string[] An array that contains the names of the constants in this enumeration.
   */
  public static function getNames(): array {
    return array_keys(static::getEntries());
  }

  /**
   * Retrieves an array of the values of the constants in this enumeration.
   * @return array An array that contains the values of the constants in this enumeration.
   */
  public static function getValues(): array {
    return array_values(static::getEntries());
  }
}
