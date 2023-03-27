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

use Eduroo\Component\Extension\Application\DependencyInjection\Definition\Exception\ServiceIdIsNotFcqnException;
use Eduroo\Component\Extension\Application\DependencyInjection\Definition\{ArgumentDefinition, ServiceDefinition, TagDefinition};
use Tests\Stubs\DummyClass;

it('should return the id', function (): void {
    $serviceDefinition = new ServiceDefinition('id');

    expect($serviceDefinition->getId())
        ->toBe('id')
    ;
});

it('should throw exception when no class defined explicitly and id is not a valid FCQN', function (): void {
    $serviceDefinition = new ServiceDefinition('id');

    $serviceDefinition->getClass();
})->throws(ServiceIdIsNotFcqnException::class);

it('should return the ID when no class defined explicitly and is valid FCQN', function (): void {
    $serviceDefinition = new ServiceDefinition(DummyClass::class);

    expect($serviceDefinition->getClass())
        ->toBe(DummyClass::class)
    ;
});

it('should return the class when defined explicitly', function (): void {
    $serviceDefinition = new ServiceDefinition('id', DummyClass::class);

    expect($serviceDefinition->getClass())
        ->toBe(DummyClass::class)
    ;
});

it('should return the arguments', function (): void {
    $argumentOne = new ArgumentDefinition('arg1');
    $argumentTwo = new ArgumentDefinition('arg2');
    $serviceDefinition = new ServiceDefinition('id', arguments: [$argumentOne, $argumentTwo]);

    expect($serviceDefinition->getArguments())
        ->toBe([$argumentOne, $argumentTwo])
    ;
});

it('should return the tags', function (): void {
    $tagOne = new TagDefinition('tag1');
    $tagTwo = new TagDefinition('tag2');

    $serviceDefinition = new ServiceDefinition('id', tags: [$tagOne, $tagTwo]);

    expect($serviceDefinition->getTags())
        ->toBe([$tagOne, $tagTwo])
    ;
});
