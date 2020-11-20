<?php
namespace Jiajiale\LaravelSeafile\Facades;

use Illuminate\Support\Facades\Facade;

class Seafile extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-seafile';
    }
}