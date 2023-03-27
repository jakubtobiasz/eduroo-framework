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

use Eduroo\Component\Extension\Application\DependencyInjection\Bag\Exception\ServiceNotFound;
use Eduroo\Component\Extension\Application\DependencyInjection\Definition\{ArgumentDefinitionInterface, ServiceDefinition, ServiceDefinitionInterface, TagDefinitionInterface};

final class ServicesBag implements ServicesBagInterface
{
    /** @var array<ServiceDefinitionInterface> */
    private array $services = [];

    /**
     * @param array<ArgumentDefinitionInterface> $arguments
     * @param array<TagDefinitionInterface> $tags
     */
    public function add(
        string $id,
        ?string $class = null,
        array $arguments = [],
        array $tags = [],
    ): ServicesBagInterface {
        $this->services[$id] = new ServiceDefinition($id, $class, $arguments, $tags);

        return $this;
    }

    /**
     * @throws ServiceNotFound
     */
    public function get(string $id): ServiceDefinitionInterface
    {
        if (! $this->has($id)) {
            throw new ServiceNotFound($id);
        }

        return $this->services[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }

    /**
     * @return array<ServiceDefinitionInterface>
     */
    public function all(): array
    {
        return $this->services;
    }
}
