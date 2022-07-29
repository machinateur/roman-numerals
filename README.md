# Roman numerals

A PHP library to convert ordinary integers to roman numerals (and back). Just like that.

## Prerequisites

* [PHP 5.6](https://www.php.net/downloads.php) or newer
* [Composer](https://getcomposer.org/download/)

Yes, you've read that right, PHP 5.6 is the minimum version requirement to be able to use this package. That is to
support legacy projects, at least for some versions. The minimum PHP version requirement might be raised in the future.

## Installation

Via composer:

```bash
# install the latest version
composer require "machinateur/roman-numerals"
```

## Usage

```php
<?php

use Machinateur\RomanNumerals\Convert;

$romanNumeral = Convert::toRomanNumeral(399);
$integer = Convert::toInteger($romanNumeral);

echo "{$integer} = {$romanNumeral}";
// 399 = CCCXCIX

```

## About

> Roman numerals are a numeral system that originated in ancient Rome and remained the usual way of writing numbers
> throughout Europe well into the Late Middle Ages. Numbers in this system are represented by combinations of letters
> from the Latin alphabet. Modern style uses seven symbols, each with a fixed integer value:
>
> | Symbol | I | V | X  | L  | C   | D   | M    |
> |--------|---|---|----|----|-----|-----|------|
> | Value  | 1 | 5 | 10 | 50 | 100 | 500 | 1000 |
> 
> The use of Roman numerals continued long after the decline of the Roman Empire. From the 14th century on, Roman
> numerals began to be replaced by Arabic numerals; however, this process was gradual, and the use of Roman numerals
> persists in some applications to this day.
> 
> [...]
> 
> "Place-keeping" zeros are alien to the system of Roman numerals - [some] used the letter N, the initial of *nulla*
> (the Latin word meaning "none") or of *nihil* (the Latin word for "nothing") for 0.
> 
> [...]
> 
> The largest number that can be represented in this notation is 3,999 (MMMCMXCIX), but since the largest Roman numeral
> likely to be required today is MMXXII (the current year) there is no practical need for larger Roman numerals.

*from [https://en.wikipedia.org/wiki/Roman_numerals](https://en.wikipedia.org/wiki/Roman_numerals)*

## License

It's MIT.
