<?php

namespace App\Integration\Aci\Response;

class Risk
{
    function __construct(
        public string $score
    ) {}
}
