<?php

declare(strict_types=1);

namespace Lightit\Appointments\Domain\Actions;

use Lightit\Appointments\Domain\DataTransferObjects\AppointmentDto;
use Lightit\Appointments\Domain\Exceptions\AppointmentOverlapException;
use Lightit\Appointments\Domain\Models\Appointment;
use Lightit\Doctors\Domain\Actions\ValidateDoctorBelongsToClinicAction;

final class StoreAppointmentAction
{
    public function __construct(
        private readonly ValidateDoctorBelongsToClinicAction $validateDoctorBelongsToClinicAction,
    ) {
    }

    public function execute(AppointmentDto $appointmentDto): Appointment
    {
        $this->appointmentOverlapsForDoctor($appointmentDto);
        $this->appointmentOverlapsForPatient($appointmentDto);
        $this->validateDoctorBelongsToClinicAction->execute(
            doctorId: $appointmentDto->doctorId,
            clinicId: $appointmentDto->clinicId,
        );

        $appointment = new Appointment();

        $appointment->doctor_id = $appointmentDto->doctorId;
        $appointment->patient_id = $appointmentDto->patientId;
        $appointment->clinic_id = $appointmentDto->clinicId;
        $appointment->starts_at = $appointmentDto->startsAt;
        $appointment->ends_at = $appointmentDto->endsAt;
        
        $appointment->saveOrFail();

        return $appointment->load(['doctor', 'patient', 'clinic']);
    }

    private function appointmentOverlapsForDoctor(AppointmentDto $appointmentDto): void
    {
        $appointmentOverlaps = Appointment::withoutTrashed()
            ->where('doctor_id', $appointmentDto->doctorId)
            ->where('starts_at', '<=', $appointmentDto->endsAt)
            ->where('ends_at', '>=', $appointmentDto->startsAt)
            ->exists();

        if ($appointmentOverlaps) {
            throw new AppointmentOverlapException('The appointment overlaps with another appointment for the doctor');
        }
    }

    private function appointmentOverlapsForPatient(AppointmentDto $appointmentDto): void
    {
        $appointmentOverlaps = Appointment::withoutTrashed()
            ->where('patient_id', $appointmentDto->patientId)
            ->where('starts_at', '<=', $appointmentDto->endsAt)
            ->where('ends_at', '>=', $appointmentDto->startsAt)
            ->exists();

        if ($appointmentOverlaps) {
            throw new AppointmentOverlapException('The appointment overlaps with another appointment for the patient');
        }
    }
}
