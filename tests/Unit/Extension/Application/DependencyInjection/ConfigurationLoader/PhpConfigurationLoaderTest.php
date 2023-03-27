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

use Eduroo\Component\Extension\Application\DependencyInjection\ConfigurationLoader\Exception\ConfigurationNotLoadedException;
use Eduroo\Component\Extension\Application\DependencyInjection\ConfigurationLoader\PhpConfigurationLoader;
use Tests\Stubs\{DummyClass, ZummyClass};

$dummyConfigPath = dirname(__DIR__, 5) . '/Stubs/dummy_config.php';

it('should throw an exception when trying to access parameters before loading configuration', function (): void {
    $configurationLoader = new PhpConfigurationLoader();

    $configurationLoader->getParameters();
})->throws(ConfigurationNotLoadedException::class);

it('should throw an exception when trying to access services before loading configuration', function (): void {
    $configurationLoader = new PhpConfigurationLoader();

    $configurationLoader->getServices();
})->throws(ConfigurationNotLoadedException::class);

it('should load parameters and services from PHP configuration file', function () use ($dummyConfigPath): void {
    $configurationLoader = new PhpConfigurationLoader();

    $configurationLoader->load($dummyConfigPath);

    $parameters = $configurationLoader->getParameters();
    $services = $configurationLoader->getServices();

    expect($services)
        ->toHaveKeys([DummyClass::class, 'zummy_service'])
        ->and($services[DummyClass::class]->getClass())->toBe(DummyClass::class)
        ->and($services['zummy_service']->getClass())->toBe(ZummyClass::class)
        ->and($parameters['example_one']->getValue())->toBe('value_one')
        ->and($parameters['example_two']->getValue())->toBe('value_two')
    ;
});
