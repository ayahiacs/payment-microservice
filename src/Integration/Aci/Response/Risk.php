<?php

namespace App\Integration\Aci\Response;

class Risk
{
    public function __construct(
        public string $score,
    ) {
    }
}
