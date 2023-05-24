<?php

namespace microwin7\Exceptions;

class ServerNotFound extends \Exception
{
    function __construct() {
        parent::__construct("Запрашиваемый сервер не найден");
    }
}
