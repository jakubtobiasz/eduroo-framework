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

use Eduroo\Component\Extension\Application\DependencyInjection\Definition\ParameterDefinition;

it('should return the name', function (): void {
    $parameterDefinition = new ParameterDefinition('foo', 'bar');

    expect($parameterDefinition->getName())
        ->toBe('foo')
    ;
});

it('should return the value', function (): void {
    $parameterDefinition = new ParameterDefinition('foo', 'bar');

    expect($parameterDefinition->getValue())
        ->toBe('bar')
    ;
});
