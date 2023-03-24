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

use Eduroo\Component\Extension\Application\Registry\TemplateHooksRegistry;
use Eduroo\Component\Extension\Application\TemplateHook\TemplateHookInterface;

it('should return empty array when no hooks are registered', function (): void {
    $registry = new TemplateHooksRegistry();

    $hooks = iterator_to_array($registry->findByMount('mount'));

    expect($hooks)
        ->toBeEmpty()
    ;
});

it('should return registered hooks regarding priority', function (): void {
    $registry = new TemplateHooksRegistry();
    $templateHookOne = Mockery::mock(TemplateHookInterface::class);
    $templateHookTwo = Mockery::mock(TemplateHookInterface::class);
    $templateHookThree = Mockery::mock(TemplateHookInterface::class);

    $registry->add('mount', $templateHookOne, 5);
    $registry->add('mount', $templateHookTwo, 10);
    $registry->add('mount', $templateHookThree, 7);

    $hooks = iterator_to_array($registry->findByMount('mount'));

    expect($hooks)
        ->toHaveLength(3)
        ->and($hooks[0])->toBe($templateHookTwo)
        ->and($hooks[1])->toBe($templateHookThree)
        ->and($hooks[2])->toBe($templateHookOne)
    ;
});
