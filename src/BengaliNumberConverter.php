<?php
// src/BengaliNumberConverter.php

namespace Khairat\BengaliNumber;

class BengaliNumberConverter
{
    protected array $numbers = [
        0 => 'শূন্য',
        1 => 'এক',
        2 => 'দুই',
        3 => 'তিন',
        4 => 'চার',
        5 => 'পাঁচ',
        6 => 'ছয়',
        7 => 'সাত',
        8 => 'আট',
        9 => 'নয়',
        10 => 'দশ',
        11 => 'এগারো',
        12 => 'বারো',
        13 => 'তেরো',
        14 => 'চৌদ্দ',
        15 => 'পনেরো',
        16 => 'ষোল',
        17 => 'সতেরো',
        18 => 'আঠারো',
        19 => 'উনিশ',
        20 => 'বিশ',
        21 => 'একুশ',
        22 => 'বাইশ',
        23 => 'তেইশ',
        24 => 'চব্বিশ',
        25 => 'পঁচিশ',
        26 => 'ছাব্বিশ',
        27 => 'সাতাশ',
        28 => 'আটাশ',
        29 => 'ঊনত্রিশ',
        30 => 'ত্রিশ',
        31 => 'একত্রিশ',
        32 => 'বত্রিশ',
        33 => 'তেত্রিশ',
        34 => 'চৌত্রিশ',
        35 => 'পঁয়ত্রিশ',
        36 => 'ছত্রিশ',
        37 => 'সাঁইত্রিশ',
        38 => 'আটত্রিশ',
        39 => 'ঊনচল্লিশ',
        40 => 'চল্লিশ',
        41 => 'একচল্লিশ',
        42 => 'বিয়াল্লিশ',
        43 => 'তেতাল্লিশ',
        44 => 'চুয়াল্লিশ',
        45 => 'পঁয়তাল্লিশ',
        46 => 'ছেচল্লিশ',
        47 => 'সাতচল্লিশ',
        48 => 'আটচল্লিশ',
        49 => 'ঊনপঞ্চাশ',
        50 => 'পঞ্চাশ',
        51 => 'একান্ন',
        52 => 'বায়ান্ন',
        53 => 'তিপ্পান্ন',
        54 => 'চুয়ান্ন',
        55 => 'পঞ্চান্ন',
        56 => 'ছাপ্পান্ন',
        57 => 'সাতান্ন',
        58 => 'আটান্ন',
        59 => 'ঊনষাট',
        60 => 'ষাট',
        61 => 'একষট্টি',
        62 => 'বাষট্টি',
        63 => 'তেষট্টি',
        64 => 'চৌষট্টি',
        65 => 'পঁয়ষট্টি',
        66 => 'ছেষট্টি',
        67 => 'সাতষট্টি',
        68 => 'আটষট্টি',
        69 => 'ঊনসত্তর',
        70 => 'সত্তর',
        71 => 'একাত্তর',
        72 => 'বাহাত্তর',
        73 => 'তিয়াত্তর',
        74 => 'চুয়াত্তর',
        75 => 'পঁচাত্তর',
        76 => 'ছিয়াত্তর',
        77 => 'সাতাত্তর',
        78 => 'আটাত্তর',
        79 => 'ঊনআশি',
        80 => 'আশি',
        81 => 'একাশি',
        82 => 'বিরাশি',
        83 => 'তিরাশি',
        84 => 'চুরাশি',
        85 => 'পঁচাশি',
        86 => 'ছিয়াশি',
        87 => 'সাতাশি',
        88 => 'আটাশি',
        89 => 'ঊননব্বই',
        90 => 'নব্বই',
        91 => 'একানব্বই',
        92 => 'বিরানব্বই',
        93 => 'তিরানব্বই',
        94 => 'চুরানব্বই',
        95 => 'পঁচানব্বই',
        96 => 'ছিয়ানব্বই',
        97 => 'সাতানব্বই',
        98 => 'আটানব্বই',
        99 => 'নিরানব্বই',
        100 => 'একশ'
    ];

    protected array $units = [
        100 => 'শত',
        1000 => 'হাজার',
        100000 => 'লক্ষ',
        10000000 => 'কোটি'
    ];

    protected array $decimalUnits = [
        1 => 'দশমিক',
        2 => 'শতাংশ',
        3 => 'সহস্রাংশ'
    ];

    public function convert(float|int|string $number): string
    {
        if (!is_numeric($number)) {
            throw new \InvalidArgumentException('Input must be a numeric value');
        }

        $number = (string) $number;
        
        if (str_contains($number, '.')) {
            return $this->convertDecimal($number);
        }

        return $this->convertInteger((int) $number);
    }

    public function convertInteger(int $number): string
    {
        if ($number < 0) {
            return 'ঋণাত্মক ' . $this->convertInteger(abs($number));
        }

        if ($number <= 100) {
            return $this->numbers[$number] ?? $this->buildNumber($number);
        }

        return $this->buildLargeNumber($number);
    }

    public function convertDecimal(string $number): string
    {
        $parts = explode('.', $number);
        $integerPart = (int) $parts[0];
        $decimalPart = $parts[1];

        $result = $this->convertInteger($integerPart) . ' দশমিক';

        // Convert each digit of decimal part individually
        $decimalDigits = str_split($decimalPart);
        foreach ($decimalDigits as $digit) {
            $result .= ' ' . $this->numbers[(int) $digit];
        }

        return $result;
    }

    public function toCurrency(float $amount, string $currency = 'টাকা'): string
    {
        $parts = explode('.', (string) $amount);
        $taka = (int) $parts[0];
        $poisha = isset($parts[1]) ? (int) str_pad($parts[1], 2, '0') : 0;

        $result = $this->convertInteger($taka) . ' ' . $currency;

        if ($poisha > 0) {
            $result .= ' ' . $this->convertInteger($poisha) . ' পয়সা';
        }

        return $result;
    }

    protected function buildNumber(int $number): string
    {
        if ($number <= 100) {
            return $this->numbers[$number];
        }

        return $this->buildLargeNumber($number);
    }

    protected function buildLargeNumber(int $number): string
    {
        $result = '';

        foreach (array_reverse($this->units, true) as $unitValue => $unitName) {
            if ($number >= $unitValue) {
                $base = floor($number / $unitValue);
                $remainder = $number % $unitValue;

                if ($base > 0) {
                    if ($unitValue === 100) {
                        $result .= ($base > 1 ? $this->convertInteger($base) . ' ' : '') . $unitName;
                    } else {
                        $result .= $this->convertInteger($base) . ' ' . $unitName;
                    }
                }

                if ($remainder > 0) {
                    $result .= ' ' . $this->convertInteger($remainder);
                }

                return trim($result);
            }
        }

        return $this->numbers[$number] ?? (string) $number;
    }

    // Helper method for direct number conversion
    public function toWords(float|int|string $number): string
    {
        return $this->convert($number);
    }

    // Format number to Bengali digits
    public function toBengaliDigits(float|int|string $number): string
    {
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        return str_replace($englishDigits, $bengaliDigits, (string) $number);
    }
}
