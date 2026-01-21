<?php

declare(strict_types=1);

namespace Lightit\Patients\Domain\Actions;

use Lightit\Patients\Domain\DataTransferObjects\PatientDto;
use Lightit\Patients\Domain\Models\Patient;

final class UpsertPatientAction
{
    public function execute(PatientDto $patientDto, Patient|null $patient = null): Patient
    {
        $patient ??= new Patient();

        $patient->first_name = $patientDto->firstName;
        $patient->last_name = $patientDto->lastName;
        $patient->email = $patientDto->email;

        $patient->saveOrFail();

        return $patient;
    }
}
