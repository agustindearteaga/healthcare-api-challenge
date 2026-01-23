<?php

declare(strict_types=1);

namespace Lightit\Appointments\Domain\Exceptions;

use Lightit\Shared\App\Exceptions\Http\HttpException;

class DoctorNotInClinicException extends HttpException
{
    /**
     * The HTTP status code.
     */
    protected int $status = 422;

    /**
     * The error code.
     */
    protected string $errorCode = 'doctor_not_in_clinic';

    /**
     * The error message.
     *
     * @var string
     */
    protected $message = 'The doctor does not belong to the clinic';
}
