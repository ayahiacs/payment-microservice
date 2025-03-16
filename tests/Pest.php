<?php

use App\Tests\WebTestCase;
use App\Tests\KernelTestCase;

pest()->extend(WebTestCase::class)->in('Feature/Controller');
pest()->extend(KernelTestCase::class)->in('Feature/Command');