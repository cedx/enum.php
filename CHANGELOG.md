# Changelog
This file contains highlights of what changes on each version of the [Enums for PHP](https://github.com/cedx/enum.php) package.

## Version 5.0.0
- Breaking change: dropped the `$strict` parameter of the `isDefined()` and `getName()` methods, comparisons are now always strict.
- Added the `getEntries()` method.
- Added the `getIndex()` method.

## Version 4.0.0
- Breaking change: renamed the `enum` namespace to `Enum`.
- Breaking change: the `$strict` parameter of the `isDefined()` and `getName()` methods is now `true` by default.
- Added new unit tests.

## Version 3.1.0
- Enabled the strict typing.
- Replaced [phpDocumentor](https://www.phpdoc.org) documentation generator by [ApiGen](https://github.com/ApiGen/ApiGen).
- Updated the package dependencies.

## Version 3.0.0
- Breaking change: renamed the root namespace to `enum`.
- Breaking change: reverted the name of the trait to `EnumTrait`.

## Version 2.0.0
- Breaking change: renamed the trait to `Enum`.
- Ported the unit test assertions from [TDD](https://en.wikipedia.org/wiki/Test-driven_development) to [BDD](https://en.wikipedia.org/wiki/Behavior-driven_development).
- Updated the package dependencies.

## Version 1.3.0
- Updated the package dependencies.

## Version 1.2.0
- Replaced the [Codacy](https://www.codacy.com) code coverage service by the [Coveralls](https://coveralls.io) one.
- Updated the package dependencies.

## Version 1.1.0
- Added a `$strict` parameter to `isDefined` and `getName` methods. 

## Version 1.0.0
- Initial release.
