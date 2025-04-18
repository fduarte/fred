<?php

declare(strict_types=1);

arch()
    ->expect('App')
    ->toUseStrictTypes()
    ->not->toUse(['die', 'dd', 'dump']);

arch()
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend('Illuminate\Database\Eloquent\Model')
    ->toOnlyBeUsedIn('App\Repositories')
    ->ignoring('App\Models\User');

arch()
    ->expect('App\Http')
    ->toOnlyBeUsedIn('App\Http');

// arch()
//    ->expect('App\*\Traits')
//    ->toBeTraits();

arch('enums')
    ->expect('App\*\Enums')
    ->toBeEnums();

arch('actions')
    ->expect('App\Actions')
    ->toBeInvokable();

arch('contracts')
    ->expect('App\*\Contracts')
    ->toBeInterfaces();

arch()->preset()->php();
arch()->preset()->security();
// arch()->preset()->laravel();
