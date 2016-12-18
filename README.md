# Enums for PHP
![Release](https://img.shields.io/packagist/v/cedx/enum.svg) ![License](https://img.shields.io/packagist/l/cedx/enum.svg) ![Downloads](https://img.shields.io/packagist/dt/cedx/enum.svg) ![Code quality](https://img.shields.io/codacy/grade/7a0c262318a4418ba7482caae54ae126.svg) ![Build](https://img.shields.io/travis/cedx/enum.php.svg)

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
Just use the `cedx\EnumTrait` trait on a class:

```php
/**
 * Specifies the day of the week.
 */
final class DayOfWeek {
  use \cedx\EnumTrait;
  
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

Thus, the obtained enumeration can only contain static members. You should only use constants, and possibly methods.

### Work with the enumeration
Check whether a value is defined among the enumerated type:

```php
DayOfWeek::isDefined(DayOfWeek::TUESDAY); // true
DayOfWeek::isDefined('Foo'); // false
```

Get the name associated to an enumerated value:

```php
DayOfWeek::getName(DayOfWeek::TUESDAY); // "TUESDAY"
DayOfWeek::getName('Bar'); // "" (empty)
```

Get information about the enumerated type:

```php
DayOfWeek::getNames();
// ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"]

DayOfWeek::getValues();
// [0, 1, 2, 3, 4, 5, 6]
```

### Comparison strictness
When using the `isDefined` or `getName` methods, a loose comparison is performed: the value type is not checked. To force a strict comparison of the value type, you can use the `$strict` parameter and set it to `true`:

```php
// Loose comparison: an empty string is equivalent to zero.
DayOfWeek::isDefined('', false); // true
DayOfWeek::getName('', false); // "SUNDAY"

// Strict comparison: an empty string is not equal to zero.
DayOfWeek::isDefined('', true); // false
DayOfWeek::getName('', true); // "" (empty)
```


## See Also
- [Code Quality](https://www.codacy.com/app/cedx/enum-php)
- [Continuous Integration](https://travis-ci.org/cedx/enum.php)

## License
[Enums for PHP](https://github.com/cedx/enum.php) is distributed under the Apache License, version 2.0.
