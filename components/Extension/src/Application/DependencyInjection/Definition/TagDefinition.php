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

final readonly class TagDefinition implements TagDefinitionInterface
{
    /** @var array<array-key, mixed> */
    private array $options;

    /**
     * @param array<array-key, mixed> $options
     */
    public function __construct(
        private string $name,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<array-key, mixed>
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
