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

use Eduroo\Component\Extension\Application\DependencyInjection\Bag\Exception\ParameterNotFound;
use Eduroo\Component\Extension\Application\DependencyInjection\Bag\ParametersBag;
use Eduroo\Component\Extension\Application\DependencyInjection\Definition\ParameterDefinition;

it('should allow to add a parameter', function (): void {
    $bag = new ParametersBag();
    $bag->add('foo', 'bar');

    $fooParameter = $bag->get('foo');

    expect($fooParameter)
        ->toBeInstanceOf(ParameterDefinition::class)
        ->and($fooParameter->getValue())
        ->toBe('bar')
    ;
});

it('should throw an exception when trying to get a non-existing parameter', function (): void {
    $bag = new ParametersBag();

    $bag->get('foo');
})->throws(ParameterNotFound::class);

it('should return whether a parameter exists', function (): void {
    $bag = new ParametersBag();
    $bag->add('foo', 'bar');

    expect($bag->has('foo'))
        ->toBeTrue()
        ->and($bag->has('bar'))
        ->toBeFalse()
    ;
});

it('should return all parameters', function (): void {
    $bag = new ParametersBag();
    $bag
        ->add('foo', 'bar')
        ->add('bar', 'baz')
    ;

    $parameters = $bag->all();
    $fooParameter = current($parameters);
    $barParameter = next($parameters);

    expect($fooParameter)
        ->toBeInstanceOf(ParameterDefinition::class)
        ->and($fooParameter->getValue())
        ->toBe('bar')
        ->and($barParameter)
        ->toBeInstanceOf(ParameterDefinition::class)
        ->and($barParameter->getValue())
        ->toBe('baz')
    ;
});
