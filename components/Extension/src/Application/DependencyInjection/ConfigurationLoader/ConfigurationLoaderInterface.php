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

namespace Eduroo\Component\Extension\Application\DependencyInjection\ConfigurationLoader;

use Eduroo\Component\Extension\Application\DependencyInjection\Definition\{ParameterDefinitionInterface, ServiceDefinitionInterface};

interface ConfigurationLoaderInterface
{
    public function load(string $configPath): void;

    /**
     * @return array<ServiceDefinitionInterface>
     * @throw ConfigurationNotLoadedException
     */
    public function getServices(): array;

    /**
     * @return array<ParameterDefinitionInterface>
     * @throw ConfigurationNotLoadedException
     */
    public function getParameters(): array;
}
