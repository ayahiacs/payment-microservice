<?php

namespace App\Integration\Aci\Response;

class Result
{
    function __construct(
        public string $code,
        public string  $description
    ) {}
}
