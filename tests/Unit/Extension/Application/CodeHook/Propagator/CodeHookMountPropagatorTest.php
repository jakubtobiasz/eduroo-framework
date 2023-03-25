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

use Eduroo\Component\Extension\Application\CodeHook\CodeHookInterface;
use Eduroo\Component\Extension\Application\CodeHook\Propagator\CodeHookMountPropagator;
use Eduroo\Component\Extension\Application\CodeHook\Registry\CodeHooksRegistryInterface;

it('should invoke all code hooks for a propagated mount', function (): void {
    $codeHookOne = Mockery::mock(CodeHookInterface::class);
    $codeHookOne->expects('__invoke')
        ->with([
            'foo' => 'bar',
        ])->once();
    $codeHookTwo = Mockery::mock(CodeHookInterface::class);
    $codeHookTwo->expects('__invoke')
        ->with([
            'foo' => 'bar',
        ])->once();

    $registry = Mockery::mock(CodeHooksRegistryInterface::class);
    $registry->expects('findByMount')
        ->with('mountName')
        ->andReturnUsing(function () use ($codeHookOne, $codeHookTwo) {
            yield $codeHookOne;
            yield $codeHookTwo;
        })
    ;

    $propagator = new CodeHookMountPropagator($registry);
    $propagator->propagate('mountName', [
        'foo' => 'bar',
    ]);
});
