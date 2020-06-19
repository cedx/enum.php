<?php declare(strict_types=1);
use Enum\EnumTrait;

/** Specifies the day of the week. */
final class DayOfWeek {
	use EnumTrait;

	const sunday = 0;
	const monday = 1;
	const tuesday = 2;
	const wednesday = 3;
	const thursday = 4;
	const friday = 5;
	const saturday = 6;
}

/** Works with the enumeration. */
function main(): void {
	// Check whether a value is defined among the enumerated type.
	DayOfWeek::isDefined(DayOfWeek::sunday); // true
	DayOfWeek::isDefined("foo"); // false

	// Ensure that a value is defined among the enumerated type.
	DayOfWeek::assert(DayOfWeek::monday); // DayOfWeek::monday
	DayOfWeek::assert("foo"); // (throws \UnexpectedValueException)

	DayOfWeek::coerce(DayOfWeek::monday); // DayOfWeek::monday
	DayOfWeek::coerce("bar"); // null
	DayOfWeek::coerce("baz", DayOfWeek::tuesday); // DayOfWeek::tuesday

	// Get the zero-based position of a value in the enumerated type declaration.
	DayOfWeek::getIndex(DayOfWeek::wednesday); // 3
	DayOfWeek::getIndex("foo"); // -1

	// Get the name associated to an enumerated value.
	DayOfWeek::getName(DayOfWeek::thursday); // "thursday"
	DayOfWeek::getName("foo"); // "" (empty)

	// Get information about the enumerated type.
	DayOfWeek::getEntries();
	// ["sunday" => 0, "monday" => 1, "tuesday" => 2, "wednesday" => 3, "thursday" => 4, "friday" => 5, "saturday" => 6]

	DayOfWeek::getNames();
	// ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"]

	DayOfWeek::getValues();
	// [0, 1, 2, 3, 4, 5, 6]
}
