<?php

declare(strict_types=1);

namespace Eduroo\Component\Extension\Application\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class AsTemplateHook
{
    public function __construct(
        public string $name,
        public int $priority = 0,
    ) {
    }
}
