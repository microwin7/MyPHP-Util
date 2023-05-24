<?php

namespace microwin7\Exceptions;

class SolutionDisabledException extends \Exception
{
    function __construct() {
        parent::__construct("Функция отключена или решение не может быть вызвано");
    }
}
