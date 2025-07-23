<?php

namespace Hynek\PackageTools\Exceptions;

class InvalidPackage extends \Exception
{
    public static function nameIsRequired(): self
    {
        return new static('This package does not have a name. You can set one with `$package->name("yourName")`');
    }
}
