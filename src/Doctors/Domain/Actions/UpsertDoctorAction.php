<?php

declare(strict_types=1);

namespace Lightit\Doctors\Domain\Actions;

use Lightit\Doctors\Domain\Models\Doctor;

class UpsertDoctorAction
{
    public function execute(Doctor|null $doctor = null, string $doctorName): Doctor
    {
        $doctor ??= new Doctor();

        $doctor->name = $doctorName;
        $doctor->saveOrFail();

        return $doctor;
    }
}

