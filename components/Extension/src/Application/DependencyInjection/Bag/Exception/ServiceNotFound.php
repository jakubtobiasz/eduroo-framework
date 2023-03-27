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

namespace Eduroo\Component\Extension\Application\DependencyInjection\Bag\Exception;

use Exception;
use Throwable;

class ServiceNotFound extends Exception
{
    public function __construct(string $serviceId, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Service with id "%s" not found.', $serviceId),
            $code,
            $previous,
        );
    }
}
