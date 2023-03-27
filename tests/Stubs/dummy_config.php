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

use Eduroo\Component\Extension\Application\DependencyInjection\Bag\{ParametersBagInterface, ServicesBagInterface};

use function Eduroo\Component\Extension\Application\DependencyInjection\ConfigurationLoader\{parameter, service, tag};

use Tests\Stubs\{DummyClass, ZummyClass};

return function (ParametersBagInterface $parametersBag, ServicesBagInterface $servicesBag): void {
    $parametersBag
        ->add('example_one', 'value_one')
        ->add('example_two', 'value_two')
    ;

    $servicesBag
        ->add(
            id: DummyClass::class,
            arguments: [parameter('parameter'), service(ZummyClass::class)],
            tags: [
                tag('example_tag', options: [
                    'priority' => 10,
                ]),
            ],
        )
    ;

    $servicesBag
        ->add(id: 'zummy_service', class: ZummyClass::class)
    ;
};
