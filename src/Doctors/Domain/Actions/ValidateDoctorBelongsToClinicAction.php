<?php

declare(strict_types=1);

namespace Lightit\Doctors\Domain\Actions;

use Lightit\Doctors\Domain\Models\Doctor;
use Lightit\Shared\App\Exceptions\Http\DoctorNotInClinicException;

final class ValidateDoctorBelongsToClinicAction
{
    public function execute(int $doctorId, int $clinicId): void
    {
        $doctorBelongsToClinic = Doctor::query()
            ->where('id', $doctorId)
            ->whereHas(
                'clinics',
                fn ($q) => $q->where('clinics.id', $clinicId)
            )
            ->exists();

        if (! $doctorBelongsToClinic) {
            throw new DoctorNotInClinicException();
        }
    }
}
