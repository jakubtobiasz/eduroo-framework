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

namespace Eduroo\Component\Extension\Application\TemplateHook\Registry;

use Eduroo\Component\Extension\Application\TemplateHook\TemplateHookInterface;
use SplPriorityQueue;

final class TemplateHooksRegistry implements TemplateHooksRegistryInterface
{
    /** @var array<SplPriorityQueue<int, TemplateHookInterface>> */
    private array $templateHooks = [];

    public function add(string $hookMountName, TemplateHookInterface $templateHook, int $priority = 0): void
    {
        if (! array_key_exists($hookMountName, $this->templateHooks)) {
            /** @var SplPriorityQueue<int, TemplateHookInterface> $queue */
            $queue = new SplPriorityQueue();
            $this->templateHooks[$hookMountName] = $queue;
        }

        $this->templateHooks[$hookMountName]->insert($templateHook, $priority);
    }

    /**
     * @return iterable<TemplateHookInterface>
     */
    public function findByMount(string $mountName): iterable
    {
        if (! array_key_exists($mountName, $this->templateHooks)) {
            return [];
        }

        foreach ($this->templateHooks[$mountName] as $templateHook) {
            yield $templateHook;
        }
    }
}
