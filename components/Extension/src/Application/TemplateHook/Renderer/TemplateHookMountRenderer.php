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

namespace Eduroo\Component\Extension\Application\TemplateHook\Renderer;

use Eduroo\Component\Extension\Application\TemplateHook\Registry\TemplateHooksRegistryInterface;
use Eduroo\Component\Extension\Application\TemplateHook\Renderer\Exception\RenderingException;

final readonly class TemplateHookMountRenderer implements TemplateHookMountRendererInterface
{
    public function __construct(
        private RendererInterface $renderer,
        private TemplateHooksRegistryInterface $templateHooksRegistry,
    ) {
    }

    /**
     * @param array<array-key, mixed> $context
     * @throws RenderingException
     */
    public function render(string $mountName, array $context = []): string
    {
        $outputParts = [];
        $templateHooks = $this->templateHooksRegistry->findByMount($mountName);

        foreach ($templateHooks as $templateHook) {
            $outputParts[] = $templateHook->render($this->renderer, $context);
        }

        return implode(PHP_EOL, $outputParts);
    }
}
