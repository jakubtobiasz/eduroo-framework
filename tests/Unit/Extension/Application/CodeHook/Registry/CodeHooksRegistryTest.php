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
use Eduroo\Component\Extension\Application\CodeHook\Registry\CodeHooksRegistry;

it('should return empty array when no hooks are registered', function (): void {
    $registry = new CodeHooksRegistry();

    $hooks = iterator_to_array($registry->findByMount('mount'));

    expect($hooks)
        ->toBeEmpty()
    ;
});

it('should return registered hooks regarding priority', function (): void {
    $registry = new CodeHooksRegistry();
    $codeHookOne = Mockery::mock(CodeHookInterface::class);
    $codeHookTwo = Mockery::mock(CodeHookInterface::class);
    $codeHookThree = Mockery::mock(CodeHookInterface::class);

    $registry->add('mount', $codeHookOne, 5);
    $registry->add('mount', $codeHookTwo, 10);
    $registry->add('mount', $codeHookThree, 7);

    $hooks = iterator_to_array($registry->findByMount('mount'));

    expect($hooks)
        ->toHaveLength(3)
        ->and($hooks[0])->toBe($codeHookTwo)
        ->and($hooks[1])->toBe($codeHookThree)
        ->and($hooks[2])->toBe($codeHookOne)
    ;
});
