<?php
// config/bengali-number.php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | This option defines the default settings for the Bengali number converter.
    |
    */

    'default_currency' => 'টাকা',
    
    /*
    |--------------------------------------------------------------------------
    | Decimal Precision
    |--------------------------------------------------------------------------
    |
    | Maximum decimal places to convert when dealing with decimal numbers.
    |
    */
    
    'decimal_precision' => 3,

    /*
    |--------------------------------------------------------------------------
    | Use Formal Language
    |--------------------------------------------------------------------------
    |
    | Whether to use formal Bengali language in conversions.
    | If set to false, might use more colloquial terms.
    |
    */
    
    'use_formal_language' => true,
];
