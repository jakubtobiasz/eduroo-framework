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

use Eduroo\Component\Extension\Application\Registry\TemplateHooksRegistryInterface;
use Eduroo\Component\Extension\Application\Renderer\{RendererInterface, TemplateHookMountRenderer};
use Eduroo\Component\Extension\Application\TemplateHook\TemplateHookInterface;

it('should render template hooks for a given hook mount', function (): void {
    $templateHooksRegistry = createTemplateHooksRegistry();
    $renderer = Mockery::mock(RendererInterface::class);

    $templateHookMountRenderer = new TemplateHookMountRenderer($renderer, $templateHooksRegistry);

    $output = $templateHookMountRenderer->render(mountName: 'mount_name');
    $expectedOutput = <<<OUTPUT
        hook two rendered
        hook one rendered
        OUTPUT;

    expect($output)
        ->toBe($expectedOutput)
    ;
});

it('should return empty string when no hooks are registered', function (): void {
    $templateHooksRegistry = createTemplateHooksRegistry();
    $renderer = Mockery::mock(RendererInterface::class);

    $templateHookMountRenderer = new TemplateHookMountRenderer($renderer, $templateHooksRegistry);

    $output = $templateHookMountRenderer->render(mountName: 'another_mount');

    expect($output)
        ->toBe('')
    ;
});

function createTemplateHooksRegistry(): TemplateHooksRegistryInterface
{
    $templateHookOne = Mockery::mock(TemplateHookInterface::class);
    $templateHookOne->allows('render')
        ->andReturns('hook one rendered')
    ;

    $templateHookTwo = Mockery::mock(TemplateHookInterface::class);
    $templateHookTwo->allows('render')
        ->andReturns('hook two rendered')
    ;

    $templateHooksRegistry = Mockery::mock(TemplateHooksRegistryInterface::class);
    $templateHooksRegistry
        ->allows('findByMount')
        ->with('mount_name')
        ->andReturnUsing(
            function () use ($templateHookOne, $templateHookTwo) {
                yield $templateHookTwo;
                yield $templateHookOne;
            },
        )
    ;
    $templateHooksRegistry
        ->allows('findByMount')
        ->with('another_mount')
        ->andReturn([])
    ;

    return $templateHooksRegistry;
}
