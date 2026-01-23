<?php

declare(strict_types=1);

namespace Lightit\Appointments\Domain\Exceptions;

use Lightit\Shared\App\Exceptions\Http\HttpException;

class AppointmentOverlapException extends HttpException
{
    /**
     * The HTTP status code.
     */
    protected int $status = 422;

    /**
     * The error code.
     */
    protected string $errorCode = 'appointment_overlap';

    /**
     * The error message.
     *
     * @var string
     */
    protected $message = 'The appointment overlaps with another appointment';
}
