# Enums for PHP
![Runtime](https://img.shields.io/badge/php-%3E%3D7.0-brightgreen.svg) ![Release](https://img.shields.io/packagist/v/cedx/enum.svg) ![License](https://img.shields.io/packagist/l/cedx/enum.svg) ![Downloads](https://img.shields.io/packagist/dt/cedx/enum.svg) ![Coverage](https://coveralls.io/repos/github/cedx/enum.php/badge.svg) ![Build](https://travis-ci.org/cedx/enum.php.svg)

Yet another implementation of enumerated types for [PHP](https://secure.php.net).

This implementation, based on [traits](https://secure.php.net/manual/en/language.oop5.traits.php), does not try to reproduce the semantics of traditional enumerations, like the ones found in C# or Java languages.

Unlike other PHP implementations, like the [SplEnum](https://secure.php.net/manual/en/class.splenum.php) class, it does not rely on object instances. Instead, it just gives a set of static methods to ease working with the constants of a class representing an enumerated type.

## Installing via [Composer](https://getcomposer.org)
From a command prompt, run:

```shell
$ composer require cedx/enum
```

## Usage

### Create the enumeration
Just use the `Enum\EnumTrait` trait on a class:

```php
/**
 * Specifies the day of the week.
 */
abstract class DayOfWeek {
  use \Enum\EnumTrait;

  const SUNDAY = 0;
  const MONDAY = 1;
  const TUESDAY = 2;
  const WEDNESDAY = 3;
  const THURSDAY = 4;
  const FRIDAY = 5;
  const SATURDAY = 6;
}
```

The [`EnumTrait`](https://github.com/cedx/enum.php/blob/master/lib/EnumTrait.php) trait adds a private constructor to the enumerated type: it prohibits its instantiation.

Thus, the obtained enumeration can only contain static members. You should only use [scalar constants](https://secure.php.net/manual/en/function.is-scalar.php), and possibly methods.

### Work with the enumeration
Check whether a value is defined among the enumerated type:

```php
DayOfWeek::isDefined(DayOfWeek::SUNDAY); // true
DayOfWeek::isDefined('foo'); // false
```

Ensure that a value is defined among the enumerated type:

```php
DayOfWeek::assert(DayOfWeek::MONDAY); // DayOfWeek::MONDAY
DayOfWeek::assert('foo'); // (throws \UnexpectedValueException)

DayOfWeek::coerce(DayOfWeek::MONDAY); // DayOfWeek::MONDAY
DayOfWeek::coerce('bar'); // null
DayOfWeek::coerce('baz', DayOfWeek::TUESDAY); // DayOfWeek::TUESDAY
```

Get the zero-based position of a value in the enumerated type declaration:

```php
DayOfWeek::getIndex(DayOfWeek::WEDNESDAY); // 3
DayOfWeek::getIndex('foo'); // -1
```

Get the name associated to an enumerated value:

```php
DayOfWeek::getName(DayOfWeek::THURSDAY); // "THURSDAY"
DayOfWeek::getName('foo'); // "" (empty)
```

Get information about the enumerated type:

```php
DayOfWeek::getEntries();
// ["SUNDAY" => 0, "MONDAY" => 1, "TUESDAY" => 2, "WEDNESDAY" => 3, "THURSDAY" => 4, "FRIDAY" => 5, "SATURDAY" => 6]

DayOfWeek::getNames();
// ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"]

DayOfWeek::getValues();
// [0, 1, 2, 3, 4, 5, 6]
```

## See also
- [API reference](https://cedx.github.io/enum.php)
- [Code coverage](https://coveralls.io/github/cedx/enum.php)
- [Continuous integration](https://travis-ci.org/cedx/enum.php)

## License
[Enums for PHP](https://github.com/cedx/enum.php) is distributed under the MIT License.
