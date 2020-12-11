<?php declare(strict_types=1);
namespace Enum;

/** Provides static methods for enumerations. */
trait EnumTrait {

	/** Private constructor: prohibits the class instantiation. */
	final private function __construct() {}

	/**
	 * Returns the specified value if it exists in this enumeration, otherwise throws an exception.
	 * @throws \UnexpectedValueException No such constant was found.
	 */
	final static function assert(mixed $value): mixed {
		return static::isDefined($value) ? $value : throw new \UnexpectedValueException("Invalid enumerated value: $value");
	}

	/** Returns the specified value if it exists in this enumeration, otherwise returns the given default value. */
	final static function coerce(mixed $value, mixed $defaultValue = null): mixed {
		return static::isDefined($value) ? $value : $defaultValue;
	}

	/** Gets an indication whether a constant with a specified value exists in this enumeration. */
	final static function isDefined(mixed $value): bool {
		return in_array($value, static::getValues(), true);
	}

	/** Gets an associative array of the pairs of names and values of the constants in this enumeration. */
	final static function getEntries(): array {
		static $entries;
		$entries ??= (new \ReflectionClass(static::class))->getConstants(\ReflectionClassConstant::IS_PUBLIC);
		return $entries;
	}

	/**
	 * Gets the zero-based position of the constant in this enumeration that has the specified value.
	 * Returns `-1` if no such constant is found.
	 */
	final static function getIndex(mixed $value): int {
		$index = array_search($value, static::getValues(), true);
		return $index !== false ? (int) $index : -1;
	}

	/**
	 * Gets the name of the constant in this enumeration that has the specified value.
	 * Returns an empty string if no such constant is found.
	 */
	final static function getName(mixed $value): string {
		$index = static::getIndex($value);
		return $index >= 0 ? static::getNames()[$index] : "";
	}

	/** Gets an array of the names of the constants in this enumeration. */
	final static function getNames(): array {
		return array_keys(static::getEntries());
	}

	/** Gets an array of the values of the constants in this enumeration. */
	final static function getValues(): array {
		return array_values(static::getEntries());
	}
}
