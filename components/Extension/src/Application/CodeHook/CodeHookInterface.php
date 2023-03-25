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

namespace Eduroo\Component\Extension\Application\CodeHook;

interface CodeHookInterface
{
    /**
     * @param array<array-key, mixed> $context
     */
    public function __invoke(array $context): void;
}
