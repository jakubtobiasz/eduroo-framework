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

namespace Eduroo\Component\Extension\Application\Renderer;

use Eduroo\Component\Extension\Application\Renderer\Exception\RenderingException;

interface RendererInterface
{
    /**
     * @param array<array-key, mixed> $context
     * @throws RenderingException
     */
    public function render(string $templateName, array $context = []): string;
}
