<?php

declare(strict_types=1);

namespace Lightit\Doctors\Domain\DataTransferObjects;

readonly class AssignDoctorToClinicDto
{
    public function __construct(
        public array $clinicIds,
    ) {
    }
}
