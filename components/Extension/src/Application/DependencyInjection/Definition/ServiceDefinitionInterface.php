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

interface ServiceDefinitionInterface
{
    public function getId(): string;

    /**
     * @throws ServiceIdIsNotFcqnException
     */
    public function getClass(): string;

    /**
     * @return array<ArgumentDefinitionInterface>
     */
    public function getArguments(): array;

    /**
     * @return array<TagDefinitionInterface>
     */
    public function getTags(): array;
}
