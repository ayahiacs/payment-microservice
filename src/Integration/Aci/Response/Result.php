<?php

namespace App\Integration\Aci\Response;

class Result
{
    public function __construct(
        public string $code,
        public string $description,
    ) {
    }
}
