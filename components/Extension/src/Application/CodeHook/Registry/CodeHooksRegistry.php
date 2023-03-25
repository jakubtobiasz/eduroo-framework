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
use SplPriorityQueue;

final class CodeHooksRegistry implements CodeHooksRegistryInterface
{
    /** @var array<SplPriorityQueue<int, CodeHookInterface>> */
    private array $codeHooks = [];

    public function add(string $mountName, CodeHookInterface $codeHook, int $priority = 0): void
    {
        if (! array_key_exists($mountName, $this->codeHooks)) {
            /** @var SplPriorityQueue<int, CodeHookInterface> $queue */
            $queue = new SplPriorityQueue();
            $this->codeHooks[$mountName] = $queue;
        }

        $this->codeHooks[$mountName]->insert($codeHook, $priority);
    }

    public function findByMount(string $mountName): iterable
    {
        if (! array_key_exists($mountName, $this->codeHooks)) {
            return [];
        }

        foreach ($this->codeHooks[$mountName] as $codeHook) {
            yield $codeHook;
        }
    }
}
