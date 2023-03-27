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

use Eduroo\Component\Extension\Application\DependencyInjection\Definition\{ArgumentDefinition, ArgumentType};

it('should return the type', function (): void {
    $argumentDefinition = new ArgumentDefinition('foo');

    expect($argumentDefinition->getType())
        ->toBe(ArgumentType::PARAMETER)
    ;
});

it('should return the value', function (): void {
    $argumentDefinition = new ArgumentDefinition('foo');

    expect($argumentDefinition->getValue())
        ->toBe('foo')
    ;
});
