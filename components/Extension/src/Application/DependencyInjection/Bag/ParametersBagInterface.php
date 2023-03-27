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

namespace Eduroo\Component\Extension\Application\DependencyInjection\Bag;

use Eduroo\Component\Extension\Application\DependencyInjection\Definition\ParameterDefinitionInterface;

interface ParametersBagInterface
{
    public function add(string $name, mixed $value): self;

    public function get(string $name): mixed;

    public function has(string $name): bool;

    /**
     * @return array<ParameterDefinitionInterface>
     */
    public function all(): array;
}
