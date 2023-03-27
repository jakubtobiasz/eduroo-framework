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

namespace Eduroo\Component\Extension\Application\DependencyInjection\Definition\Exception;

use Exception;
use Throwable;

class ServiceIdIsNotFcqnException extends Exception
{
    public function __construct(string $id, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                'Service\'s class is not defined explicitly and Service ID "%s" is not a fully qualified class name.',
                $id,
            ),
            $code,
            $previous,
        );
    }
}
