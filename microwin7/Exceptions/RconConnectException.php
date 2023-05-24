<?php

namespace microwin7\Exceptions;

class RconConnectException extends \Exception
{
    function __construct()
    {
        parent::__construct("Соединение с сервером не установлено. Операция не выполнена");
    }
}
