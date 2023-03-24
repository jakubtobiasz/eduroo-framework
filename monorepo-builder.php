<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\Config\MBConfig;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([__DIR__ . '/components']);

    $mbConfig->dataToAppend([
        'require-dev' => [
            'symplify/monorepo-builder' => '11.2.2.72',
            'pestphp/pest' => '^2.2',
        ]
    ]);
};
