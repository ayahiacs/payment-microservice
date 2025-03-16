<?php

arch()
    ->expect('App')
    ->not->toUse(['die', 'dd', 'dump']);

arch()
    ->expect('App\Controller')
    ->toOnlyBeUsedIn('App\Controller');

arch()
    ->expect('App\Dto')
    ->toBeFinal()
    ->toBeReadOnly();

arch()
    ->expect('App\Entity')
    ->toBeClasses()
    ->toOnlyBeUsedIn('App\Repository');

arch()
    ->expect('App\Contract')
    ->toBeInterfaces();

arch()
    ->expect('App\Service')
    ->not->toBeUsedIn('App\Integration');
