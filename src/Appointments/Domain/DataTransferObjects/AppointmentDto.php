<?php

declare(strict_types=1);

namespace Lightit\Appointments\Domain\DataTransferObjects;

use Carbon\CarbonImmutable;

final readonly class AppointmentDto
{
    public function __construct(
        public int $doctorId,
        public int $patientId,
        public int $clinicId,
        public CarbonImmutable $startsAt,
        public CarbonImmutable $endsAt,
    ) {
    }
}
