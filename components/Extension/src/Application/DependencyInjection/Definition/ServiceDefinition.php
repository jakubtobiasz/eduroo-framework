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

namespace Eduroo\Component\Extension\Application\DependencyInjection\Definition;

use Eduroo\Component\Extension\Application\DependencyInjection\Definition\Exception\ServiceIdIsNotFcqnException;

final readonly class ServiceDefinition implements ServiceDefinitionInterface
{
    /** @var array<ArgumentDefinitionInterface> */
    private array $arguments;

    /** @var array<TagDefinitionInterface> */
    private array $tags;

    /**
     * @param array<ArgumentDefinitionInterface> $arguments
     * @param array<TagDefinitionInterface> $tags
     */
    public function __construct(
        private string $id,
        private ?string $class = null,
        array $arguments = [],
        array $tags = [],
    ) {
        $this->arguments = $arguments;
        $this->tags = $tags;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @throws ServiceIdIsNotFcqnException
     */
    public function getClass(): string
    {
        if (null === $this->class && ! class_exists($this->id)) {
            throw new ServiceIdIsNotFcqnException($this->id);
        }

        if (null === $this->class) {
            return $this->id;
        }

        return $this->class;
    }

    /**
     * @return array<ArgumentDefinitionInterface>
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @return array<TagDefinitionInterface>
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
