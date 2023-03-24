<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\Config\MBConfig;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([__DIR__ . '/components']);

    $mbConfig->dataToAppend([
        'require-dev' => [
            'captainhook/captainhook' => '^5.16',
            'pestphp/pest' => '^2.2',
            'phpstan/phpstan' => '^1.10',
            'qossmic/deptrac-shim' => '^1.0',
            'symplify/monorepo-builder' => '11.2.2.72',
            'symplify/easy-coding-standard' => '^11.3',
            'vimeo/psalm' => '^5.8'
        ]
    ]);
};
