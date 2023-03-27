<?php

/*
 * This file is part of the Eduroo Framework.
 *
 * (c) Jakub Tobiasz
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Eduroo\Component\Extension\Application\DependencyInjection\Bag\Exception\ServiceNotFound;
use Eduroo\Component\Extension\Application\DependencyInjection\Bag\ServicesBag;
use Eduroo\Component\Extension\Application\DependencyInjection\Definition\ServiceDefinitionInterface;
use Tests\Stubs\{DummyClass, ZummyClass};

it('should allow to add a service', function (): void {
    $bag = new ServicesBag();
    $bag->add(DummyClass::class);

    expect($bag->get(DummyClass::class))->toBeInstanceOf(ServiceDefinitionInterface::class);
});

it('should throw an exception when trying to get a non-existing service', function (): void {
    $bag = new ServicesBag();

    $bag->get('foo');
})->throws(ServiceNotFound::class);

it('should return whether a service exists', function (): void {
    $bag = new ServicesBag();
    $bag->add(DummyClass::class);

    expect($bag->has(DummyClass::class))->toBeTrue()
        ->and($bag->has(ZummyClass::class))->toBeFalse()
    ;
});

it('should return all services', function (): void {
    $bag = new ServicesBag();
    $bag
        ->add(DummyClass::class)
        ->add(ZummyClass::class)
    ;

    $services = $bag->all();
    expect($services)
        ->toHaveKeys([DummyClass::class, ZummyClass::class])
    ;
});
