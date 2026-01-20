<?php

declare(strict_types=1);

namespace Lightit\Doctors\Domain\Actions;

use Lightit\Doctors\Domain\DataTransferObjects\AssignDoctorToClinicDto;
use Lightit\Doctors\Domain\Models\Doctor;

final class AssignDoctorToClinicAction
{
    public function execute(Doctor $doctor, AssignDoctorToClinicDto $assignDoctorToClinicDto): Doctor
    {
        $doctor->clinics()->syncWithoutDetaching($assignDoctorToClinicDto->clinicIds);

        return $doctor->load('clinics:id,name,address');
    }
}
