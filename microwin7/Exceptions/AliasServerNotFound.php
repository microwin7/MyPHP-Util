<?php

namespace microwin7\Exceptions;

class AliasServerNotFound extends \Exception
{
    function __construct() {
        parent::__construct("Запрашиваемый сервер не найден");
    }
}
