<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\Config\MBConfig;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([__DIR__ . '/components']);

    $mbConfig->dataToAppend([
        'require-dev' => [
            'pestphp/pest' => '^2.2',
            'phpstan/phpstan' => '^1.10',
            'symplify/monorepo-builder' => '11.2.2.72',
            'symplify/easy-coding-standard' => '^11.3',
        ]
    ]);
};
