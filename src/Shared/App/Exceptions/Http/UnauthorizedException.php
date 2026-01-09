<?php

declare(strict_types=1);

namespace Lightit\Shared\App\Exceptions\Http;

use Illuminate\Http\Response;

class UnauthorizedException extends HttpException
{
    /**
     * An HTTP status code.
     */
    protected int $status = Response::HTTP_UNAUTHORIZED;

    /**
     * An error code.
     */
    protected string $errorCode = 'unauthorized';
}
