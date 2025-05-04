<?php
namespace Ns\Facades;

use Ns\Classes\Config as ClassesConfig;
use Illuminate\Support\Facades\Facade;

class Config extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ClassesConfig::class;
    }
}