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

namespace Eduroo\Component\Extension\Application\Renderer\Exception;

use Exception;
use Throwable;

class RenderingException extends Exception
{
    public function __construct(string $templateName, int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('An error occurred while rendering the template "%s".', $templateName);
        parent::__construct($message, $code, $previous);
    }
}
