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

namespace Eduroo\Component\Extension\Application\TemplateHook;

use Eduroo\Component\Extension\Application\Renderer\Exception\RenderingException;
use Eduroo\Component\Extension\Application\Renderer\RendererInterface;

interface TemplateHookInterface
{
    /**
     * @param array<array-key, mixed> $context
     * @throws RenderingException
     */
    public function render(RendererInterface $renderer, array $context): string;
}
