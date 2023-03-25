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

namespace Eduroo\Component\Extension\Application\CodeHook\Propagator;

use Eduroo\Component\Extension\Application\CodeHook\Registry\CodeHooksRegistryInterface;

final readonly class CodeHookMountPropagator implements CodeHookMountPropagatorInterface
{
    public function __construct(
        private CodeHooksRegistryInterface $codeHooksRegistry,
    ) {
    }

    public function propagate(string $mountName, array $context): void
    {
        foreach ($this->codeHooksRegistry->findByMount($mountName) as $codeHook) {
            $codeHook($context);
        }
    }
}
