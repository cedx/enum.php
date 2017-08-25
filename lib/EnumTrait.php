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
   * Returns the specified value if it exists in this enumeration, otherwise throws an exception.
   * @param mixed $value The value of a constant in this enumeration.
   * @return mixed The specified enumerated constant.
   * @throws \UnexpectedValueException No such constant was found.
   */
  public static function assert($value) {
    if (static::isDefined($value)) return $value;
    throw new \UnexpectedValueException("Invalid enumerated value: $value");
  }

  /**
   * Returns the specified value if it exists in this enumeration, otherwise returns the given default value.
   * @param mixed $value The value of a constant in this enumeration.
   * @param mixed $defaultValue The default value to return if the specified constant does not exist.
   * @return mixed The specified enumerated constant, or the default value if no such constant is found.
   */
  public static function coerce($value, $defaultValue = null) {
    return static::isDefined($value) ? $value : $defaultValue;
  }

  /**
   * Gets an indication whether a constant with a specified value exists in this enumeration.
   * @param mixed $value The value of a constant in this enumeration.
   * @return bool `true` if a constant in this enumeration has the specified value, otherwise `false`.
   */
  public static function isDefined($value): bool {
    return in_array($value, static::getValues(), true);
  }

  /**
   * Gets an associative array of the pairs of names and values of the constants in this enumeration.
   * @return array An associative array that contains the pairs of names and values of the constants in this enumeration.
   */
  public static function getEntries(): array {
    static $entries;
    if (!isset($entries)) $entries = (new \ReflectionClass(static::class))->getConstants();
    return $entries;
  }

  /**
   * Gets the zero-based position of the constant in this enumeration that has the specified value.
   * @param mixed $value The value of a constant in this enumeration.
   * @return int The zero-based position of the constant that has the specified value, or `-1` if no such constant is found.
   */
  public static function getIndex($value): int {
    $index = array_search($value, static::getValues(), true);
    return $index !== false ? $index : -1;
  }

  /**
   * Gets the name of the constant in this enumeration that has the specified value.
   * @param mixed $value The value of a constant in this enumeration.
   * @return string A string containing the name of the constant that has the specified value, or an empty string if no such constant is found.
   */
  public static function getName($value): string {
    $index = static::getIndex($value);
    return $index >= 0 ? static::getNames()[$index] : '';
  }

  /**
   * Gets an array of the names of the constants in this enumeration.
   * @return string[] An array that contains the names of the constants in this enumeration.
   */
  public static function getNames(): array {
    return array_keys(static::getEntries());
  }

  /**
   * Gets an array of the values of the constants in this enumeration.
   * @return array An array that contains the values of the constants in this enumeration.
   */
  public static function getValues(): array {
    return array_values(static::getEntries());
  }
}
