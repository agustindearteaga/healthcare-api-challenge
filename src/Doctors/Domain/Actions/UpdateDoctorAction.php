<?php

declare(strict_types=1);

namespace Lightit\Doctors\Domain\Actions;

use Lightit\Doctors\Domain\Models\Doctor;

class UpdateDoctorAction
{
    public function execute(Doctor $doctor, string $doctorName): Doctor
    {
        $doctor->name = $doctorName;
        $doctor->saveOrFail();

        return $doctor;
    }
}
