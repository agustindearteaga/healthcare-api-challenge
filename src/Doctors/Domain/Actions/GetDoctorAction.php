<?php

declare(strict_types=1);

namespace Lightit\Doctors\Domain\Actions;

use Dedoc\Scramble\Attributes\Group;
use Lightit\Doctors\Domain\Models\Doctor;

#[Group('Doctors')]
final readonly class GetDoctorAction
{
    public function execute(Doctor $doctor): Doctor
    {
        return $doctor;
    }
}
