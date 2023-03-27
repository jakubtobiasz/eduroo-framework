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

use Eduroo\Component\Extension\Application\DependencyInjection\Bag\Exception\ParameterNotFound;
use Eduroo\Component\Extension\Application\DependencyInjection\Definition\{ParameterDefinition, ParameterDefinitionInterface};

final class ParametersBag implements ParametersBagInterface
{
    /** @var array<ParameterDefinitionInterface> */
    private array $parameters = [];

    public function add(string $name, mixed $value): ParametersBagInterface
    {
        $this->parameters[$name] = new ParameterDefinition($name, $value);

        return $this;
    }

    /**
     * @throws ParameterNotFound
     */
    public function get(string $name): mixed
    {
        if (! $this->has($name)) {
            throw new ParameterNotFound($name);
        }

        return $this->parameters[$name];
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }

    public function all(): array
    {
        return $this->parameters;
    }
}
