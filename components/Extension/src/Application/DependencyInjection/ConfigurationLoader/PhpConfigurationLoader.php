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

use Closure;
use Eduroo\Component\Extension\Application\DependencyInjection\Bag\{ParametersBag, ParametersBagInterface, ServicesBag, ServicesBagInterface};
use Eduroo\Component\Extension\Application\DependencyInjection\ConfigurationLoader\Exception\ConfigurationNotLoadedException;
use Eduroo\Component\Extension\Application\DependencyInjection\Definition\{ArgumentDefinition, ArgumentDefinitionInterface, ArgumentType, TagDefinition, TagDefinitionInterface};
use InvalidArgumentException;
use ReflectionException;
use ReflectionFunction;
use ReflectionNamedType;
use RuntimeException;

class PhpConfigurationLoader implements ConfigurationLoaderInterface
{
    private ServicesBagInterface $servicesBag;

    private ParametersBagInterface $parametersBag;

    private bool $isLoaded = false;

    public function __construct()
    {
        $this->servicesBag = new ServicesBag();
        $this->parametersBag = new ParametersBag();
    }

    /**
     * @throws ReflectionException
     * @psalm-suppress UnresolvableInclude
     * @psalm-suppress MissingClosureReturnType
     * @psalm-suppress MixedInferredReturnType
     * @psalm-suppress MixedReturnStatement
     * @psalm-suppress MixedAssignment
     */
    public function load(string $configPath): void
    {
        $isolatedConfigurator = new class() extends PhpConfigurationLoader {
        };
        $load = Closure::bind(function (string $path) {
            return include $path;
        }, $this, $isolatedConfigurator);

        if (! $load instanceof Closure) {
            throw new RuntimeException('Could not bind closure.');
        }

        $callback = $load($configPath);

        if (\is_object($callback) && \is_callable($callback)) {
            $this->executeCallback($callback);
        }
    }

    /**
     * @throws ConfigurationNotLoadedException
     */
    public function getServices(): array
    {
        if (! $this->isLoaded) {
            throw new ConfigurationNotLoadedException('Configuration was not loaded. Call load() method first.');
        }

        return $this->servicesBag->all();
    }

    /**
     * @throws ConfigurationNotLoadedException
     */
    public function getParameters(): array
    {
        if (! $this->isLoaded) {
            throw new ConfigurationNotLoadedException('Configuration was not loaded. Call load() method first.');
        }

        return $this->parametersBag->all();
    }

    /**
     * @throws ReflectionException
     */
    private function executeCallback(callable $callback): void
    {
        $callback = $callback(...);
        $arguments = [];

        $functionReflection = new ReflectionFunction($callback);

        foreach ($functionReflection->getParameters() as $parameter) {
            $reflectionType = $parameter->getType();
            if (! $reflectionType instanceof ReflectionNamedType) {
                throw new InvalidArgumentException(sprintf(
                    'Could not resolve argument "$%s" for "%s". You must typehint it.',
                    $parameter->getName(),
                    '',
                ));
            }
            $type = $reflectionType->getName();

            switch ($type) {
                case ServicesBagInterface::class:
                    $arguments[] = $this->servicesBag;

                    break;
                case ParametersBagInterface::class:
                    $arguments[] = $this->parametersBag;

                    break;
                default:
                    break;
            }
        }

        $callback(...$arguments);
        $this->isLoaded = true;
    }
}

function service(string $id): ArgumentDefinitionInterface
{
    return new ArgumentDefinition($id, ArgumentType::SERVICE);
}

function parameter(string $id): ArgumentDefinitionInterface
{
    return new ArgumentDefinition($id, ArgumentType::PARAMETER);
}

/**
 * @param array<array-key, mixed> $options
 */
function tag(string $name, array $options = []): TagDefinitionInterface
{
    return new TagDefinition($name, $options);
}
