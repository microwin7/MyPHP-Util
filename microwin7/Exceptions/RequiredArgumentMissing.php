<?php

namespace microwin7\Exceptions;

class RequiredArgumentMissing extends \Exception
{
    function __construct() {
        parent::__construct("Отсутствует обязательный аргумент");
    }
}
