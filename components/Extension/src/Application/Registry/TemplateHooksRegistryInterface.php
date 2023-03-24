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

namespace Eduroo\Component\Extension\Application\Registry;

use Eduroo\Component\Extension\Application\TemplateHook\TemplateHookInterface;

interface TemplateHooksRegistryInterface
{
    public function add(string $hookMountName, TemplateHookInterface $templateHook, int $priority = 0): void;

    /**
     * @return iterable<TemplateHookInterface>
     */
    public function findByMount(string $mountName): iterable;
}
