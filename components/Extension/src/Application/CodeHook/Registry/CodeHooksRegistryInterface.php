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

namespace Eduroo\Component\Extension\Application\CodeHook\Registry;

use Eduroo\Component\Extension\Application\CodeHook\CodeHookInterface;

interface CodeHooksRegistryInterface
{
    public function add(string $mountName, CodeHookInterface $codeHook, int $priority = 0): void;

    /**
     * @return iterable<CodeHookInterface>
     */
    public function findByMount(string $mountName): iterable;
}
