<?php
// test-manual.php

require_once 'vendor/autoload.php';

use Khairat\BengaliNumber\BengaliNumberConverter;

$converter = new BengaliNumberConverter();

// Test cases
echo "Testing Bengali Number Converter:\n";
echo "105731 => " . $converter->convert(105731) . "\n";
echo "500.45 => " . $converter->convert(500.45) . "\n";
echo "1000 => " . $converter->convert(1000) . "\n";
echo "Currency 500.45 => " . $converter->toCurrency(500.45) . "\n";
echo "Bengali Digits 1234 => " . $converter->toBengaliDigits(1234) . "\n";
