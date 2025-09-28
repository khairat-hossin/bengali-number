<?php
// src/Facades/BengaliNumber.php

namespace Khairat\BengaliNumber\Facades;

use Illuminate\Support\Facades\Facade;

class BengaliNumber extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bengali-number';
    }
}
