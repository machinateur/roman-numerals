<?php
/*
 * MIT License
 *
 * Copyright (c) 2021-2022 machinateur
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Machinateur\RomanNumerals;

final class Convert
{
    /**
     * @var array<string, int>
     */
    private static $SYMBOL_MAP = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    /**
     * Convert a roman numeral formatted string to its integer equivalent.
     *
     * The format is described loosely by [this regex](https://regex101.com/r/RM9IxV/1).
     *
     * @param string $romanNumeral
     * @return int
     * @throws \InvalidArgumentException Argument type is not `string`
     * @throws \UnexpectedValueException Argument format error
     */
    public static function toInteger($romanNumeral)
    {
        if (!\is_string($romanNumeral)) {
            throw new \InvalidArgumentException(\sprintf('The argument must be of type "string", got "%s"!',
                \is_object($romanNumeral) ? \get_class($romanNumeral) : \gettype($romanNumeral)), 10);
        }

        if (1 !== \preg_match('/^N|[IVXLCDM]+$/', $romanNumeral)) {
            throw new \UnexpectedValueException(\sprintf('The argument format is invalid: "%s".',
                $romanNumeral), 20);
        }

        if ('N' === $romanNumeral) {
            return 0;
        }

        $integer = 0;

        foreach (self::$SYMBOL_MAP as $symbol => $value) {
            while (0 === \strpos($romanNumeral, $symbol)) {
                $romanNumeral = \substr($romanNumeral, \strlen($symbol));
                $integer += $value;
            }
        }

        if (0 !== strlen($romanNumeral)) {
            throw new \UnexpectedValueException(\sprintf('The argument could not fully be converted: "%s".',
                $romanNumeral), 30);
        }

        return $integer;
    }

    /**
     * @param int $integer
     * @return string
     * @throws \InvalidArgumentException Argument type is not `int`
     * @throws \OutOfRangeException Argument is not in valid range (0,3999)
     */
    public static function toRomanNumeral($integer)
    {
        if (!\is_int($integer)) {
            throw new \InvalidArgumentException(sprintf('The argument must be of type "int", got "%s"!',
                \is_object($integer) ? \get_class($integer) : \gettype($integer)), 10);
        }

        if (0 > $integer || 3999 < $integer) {
            throw new \OutOfRangeException('The argument must be in range 0-3999!', 40);
        }

        if (0 === $integer) {
            return 'N';
        }

        $romanNumeral = '';

        foreach (self::$SYMBOL_MAP as $symbol => $value) {
            while ($value <= $integer) {
                $integer -= $value;
                $romanNumeral .= $symbol;
            }
        }

        return $romanNumeral;
    }
}
