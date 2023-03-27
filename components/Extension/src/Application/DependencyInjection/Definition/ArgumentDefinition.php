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

final readonly class ArgumentDefinition implements ArgumentDefinitionInterface
{
    public function __construct(
        private string $value,
        private ArgumentType $type = ArgumentType::PARAMETER,
    ) {
    }

    public function getType(): ArgumentType
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
