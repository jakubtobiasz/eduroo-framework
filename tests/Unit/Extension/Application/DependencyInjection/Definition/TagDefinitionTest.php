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

use Eduroo\Component\Extension\Application\DependencyInjection\Definition\TagDefinition;

it('should return the name', function (): void {
    $tagDefinition = new TagDefinition('test');

    expect($tagDefinition->getName())
        ->toBe('test')
    ;
});

it('should return the options', function (): void {
    $tagDefinition = new TagDefinition('test', [
        'option' => 'value',
    ]);

    expect($tagDefinition->getOptions())
        ->toBe([
            'option' => 'value',
        ])
    ;
});
