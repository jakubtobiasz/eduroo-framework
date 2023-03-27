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

use Eduroo\Component\Extension\Application\DependencyInjection\Definition\{ArgumentDefinitionInterface, ServiceDefinitionInterface, TagDefinitionInterface};

interface ServicesBagInterface
{
    /**
     * @param array<ArgumentDefinitionInterface> $arguments
     * @param array<TagDefinitionInterface> $tags
     */
    public function add(string $id, ?string $class = null, array $arguments = [], array $tags = []): self;

    public function get(string $id): ServiceDefinitionInterface;

    public function has(string $id): bool;

    /**
     * @return array<ServiceDefinitionInterface>
     */
    public function all(): array;
}
