<?php

declare(strict_types=1);

namespace Lightit\Doctors\Domain\Actions;

use Lightit\Doctors\Domain\Models\Doctor;

class UpsertDoctorAction
{
    public function execute(string $doctorName, Doctor|null $doctor = null): Doctor
    {
        $doctor ??= new Doctor();

        $doctor->name = $doctorName;
        $doctor->saveOrFail();

        return $doctor;
    }
}
