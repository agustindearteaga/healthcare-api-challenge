<?php

declare(strict_types=1);

namespace Lightit\Patients\Domain\DataTransferObjects;

final readonly class PatientDto
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {
    }
}
