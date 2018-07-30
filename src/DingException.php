<?php
namespace Jourdon\DingException;
use Illuminate\Support\Facades\Facade;
class DingException extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DingException';
    }
}