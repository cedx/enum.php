# Changelog

# Version [9.0.0](https://git.belin.io/cedx/enum.php/compare/v8.2.0...v9.0.0)
- Breaking change: raised the required [PHP](https://www.php.net) version.
- Breaking change: using PHP 8.0 features, like the `mixed` type and the `ReflectionClassConstant::IS_PUBLIC` constant.
- Ported the documentation to [docsify](https://docsify.js.org).
- Replaced the build system based on [Robo](https://robo.li) by [PowerShell](https://docs.microsoft.com/en-us/powershell) scripts.

# Version [8.2.0](https://git.belin.io/cedx/enum.php/compare/v8.1.0...v8.2.0)
- Updated the documentation.
- Updated the package dependencies.

# Version [8.1.0](https://git.belin.io/cedx/enum.php/compare/v8.0.0...v8.1.0)
- Updated the package dependencies.

# Version [8.0.0](https://git.belin.io/cedx/enum.php/compare/v7.5.0...v8.0.0)
- Breaking change: raised the required [PHP](https://www.php.net) version.
- Breaking change: using PHP 7.4 features, like arrow functions.

# Version [7.5.0](https://git.belin.io/cedx/enum.php/compare/v7.4.0...v7.5.0)
- Modified the package layout.
- Updated the package dependencies.

# Version [7.4.0](https://git.belin.io/cedx/enum.php/compare/v7.3.0...v7.4.0)
- Replaced the [Phing](https://www.phing.info) build system by [Robo](https://robo.li).
- Updated the package dependencies.

# Version [7.3.0](https://git.belin.io/cedx/enum.php/compare/v7.2.0...v7.3.0)
- Added support for [PHPStan](https://phpstan.org) static analyzer.
- Updated the package dependencies.

# Version [7.2.0](https://git.belin.io/cedx/enum.php/compare/v7.1.0...v7.2.0)
- Updated the package dependencies.

# Version [7.1.0](https://git.belin.io/cedx/enum.php/compare/v7.0.0...v7.1.0)
- Dropped the dependency on [PHPUnit-Expect](https://docs.belin.io/phpunit-expect).

# Version [7.0.0](https://git.belin.io/cedx/enum.php/compare/v6.1.0...v7.0.0)
- Breaking change: raised the required [PHP](https://www.php.net) version.
- Breaking change: all methods of the `EnumTrait` trait are now final.
- Updated the package dependencies.

## Version [6.1.0](https://git.belin.io/cedx/enum.php/compare/v6.0.0...v6.1.0)
- Added a user guide based on [MkDocs](http://www.mkdocs.org).
- Updated the package dependencies.

## Version [6.0.0](https://git.belin.io/cedx/enum.php/compare/v5.0.0...v6.0.0)
- Breaking change: raised the required [PHP](https://www.php.net) version.
- Breaking change: using PHP 7.1 features, like class constant visibility and void functions.
- Fixed the [issue #1](https://github.com/cedx/enum.php/issues/1): `protected` and `private` constants are now ignored.

## Version [5.0.0](https://git.belin.io/cedx/enum.php/compare/v4.0.0...v5.0.0)
- Breaking change: dropped the `$strict` parameter of the `isDefined()` and `getName()` methods, comparisons are now always strict.
- Added the `assert()` method.
- Added the `coerce()` method.
- Added the `getEntries()` method.
- Added the `getIndex()` method.
- Changed licensing for the [MIT License](https://opensource.org/licenses/MIT).

## Version [4.0.0](https://git.belin.io/cedx/enum.php/compare/v3.1.0...v4.0.0)
- Breaking change: renamed the `enum` namespace to `Enum`.
- Breaking change: the `$strict` parameter of the `isDefined()` and `getName()` methods is now `true` by default.
- Added new unit tests.

## Version [3.1.0](https://git.belin.io/cedx/enum.php/compare/v3.0.0...v3.1.0)
- Enabled the strict typing.
- Replaced [phpDocumentor](https://www.phpdoc.org) documentation generator by [ApiGen](https://github.com/ApiGen/ApiGen).
- Updated the package dependencies.

## Version [3.0.0](https://git.belin.io/cedx/enum.php/compare/v2.0.0...v3.0.0)
- Breaking change: renamed the root namespace to `enum`.
- Breaking change: reverted the name of the trait to `EnumTrait`.

## Version [2.0.0](https://git.belin.io/cedx/enum.php/compare/v1.3.0...v2.0.0)
- Breaking change: renamed the trait to `Enum`.
- Ported the unit test assertions from [TDD](https://en.wikipedia.org/wiki/Test-driven_development) to [BDD](https://en.wikipedia.org/wiki/Behavior-driven_development).
- Updated the package dependencies.

## Version [1.3.0](https://git.belin.io/cedx/enum.php/compare/v1.2.0...v1.3.0)
- Updated the package dependencies.

## Version [1.2.0](https://git.belin.io/cedx/enum.php/compare/v1.1.0...v1.2.0)
- Replaced the [Codacy](https://www.codacy.com) code coverage service by the [Coveralls](https://coveralls.io) one.
- Updated the package dependencies.

## Version [1.1.0](https://git.belin.io/cedx/enum.php/compare/v1.0.0...v1.1.0)
- Added a `$strict` parameter to `isDefined()` and `getName()` methods.

## Version 1.0.0
- Initial release.
