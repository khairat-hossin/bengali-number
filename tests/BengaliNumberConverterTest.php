<?php
// tests/BengaliNumberConverterTest.php

namespace Khairat\BengaliNumber\Tests;

use Orchestra\Testbench\TestCase;
use Khairat\BengaliNumber\Facades\BengaliNumber;
use Khairat\BengaliNumber\BengaliNumberConverter;

class BengaliNumberConverterTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Khairat\BengaliNumber\Providers\BengaliNumberServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'BengaliNumber' => 'Khairat\BengaliNumber\Facades\BengaliNumber'
        ];
    }

    public function test_integer_conversion()
    {
        $converter = new BengaliNumberConverter();

        $this->assertEquals('এক', $converter->convert(1));
        $this->assertEquals('দশ', $converter->convert(10));
        $this->assertEquals('পঁচিশ', $converter->convert(25));
        $this->assertEquals('একশ', $converter->convert(100));
        $this->assertEquals('পাঁচ শত', $converter->convert(500));
    }

    public function test_decimal_conversion()
    {
        $converter = new BengaliNumberConverter();

        $this->assertEquals(
            'পাঁচ শত দশমিক চার পাঁচ', 
            $converter->convert(500.45)
        );
        
        $this->assertEquals(
            'দশ দশমিক পাঁচ শূন্য দুই', 
            $converter->convert(10.502)
        );
    }

    public function test_currency_conversion()
    {
        $converter = new BengaliNumberConverter();

        $this->assertEquals(
            'পাঁচ শত টাকা', 
            $converter->toCurrency(500)
        );
        
        $this->assertEquals(
            'পাঁচ শত টাকা পঁয়তাল্লিশ পয়সা', 
            $converter->toCurrency(500.45)
        );
    }

    public function test_large_numbers()
    {
        $converter = new BengaliNumberConverter();

        $this->assertEquals('এক হাজার', $converter->convert(1000));
        $this->assertEquals('এক লক্ষ', $converter->convert(100000));
        $this->assertEquals('দশ লক্ষ', $converter->convert(1000000));
    }

    public function test_facade_usage()
    {
        $this->assertEquals('পাঁচ শত', BengaliNumber::convert(500));
        $this->assertEquals('পাঁচ শত দশমিক চার পাঁচ', BengaliNumber::convert(500.45));
    }

    public function test_bengali_digits()
    {
        $converter = new BengaliNumberConverter();

        $this->assertEquals('৫০০', $converter->toBengaliDigits(500));
        $this->assertEquals('৫০০.৪৫', $converter->toBengaliDigits(500.45));
    }
}
