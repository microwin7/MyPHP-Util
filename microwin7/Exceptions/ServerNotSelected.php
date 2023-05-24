<?php

namespace microwin7\Exceptions;

class ServerNotSelected extends \Exception
{
    function __construct() {
        parent::__construct("Не передан сервер для взаимодействия");
    }
}
