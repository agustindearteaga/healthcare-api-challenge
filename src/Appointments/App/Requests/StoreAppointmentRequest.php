<?php

declare(strict_types=1);

namespace Lightit\Appointments\App\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Appointments\Domain\DataTransferObjects\AppointmentDto;
use Lightit\Clinics\Domain\Models\Clinic;
use Lightit\Doctors\Domain\Models\Doctor;
use Lightit\Patients\Domain\Models\Patient;

final class StoreAppointmentRequest extends FormRequest
{
    public const string DOCTOR_ID = 'doctor_id';

    public const string PATIENT_ID = 'patient_id';

    public const string CLINIC_ID = 'clinic_id';

    public const string STARTS_AT = 'starts_at';

    public const string ENDS_AT = 'ends_at';

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            self::DOCTOR_ID => ['required', 'integer', Rule::exists(Doctor::class, 'id')],
            self::PATIENT_ID => ['required', 'integer', Rule::exists(Patient::class, 'id')],
            self::CLINIC_ID => ['required', 'integer', Rule::exists(Clinic::class, 'id')],
            self::STARTS_AT => ['required', 'date', 'after:now'],
            self::ENDS_AT => ['required', 'date', 'after:starts_at'],
        ];
    }

    public function toDto(): AppointmentDto
    {
        return new AppointmentDto(
            doctorId: $this->integer(self::DOCTOR_ID),
            patientId: $this->integer(self::PATIENT_ID),
            clinicId: $this->integer(self::CLINIC_ID),
            startsAt: CarbonImmutable::parse($this->string(self::STARTS_AT)->toString()),
            endsAt: CarbonImmutable::parse($this->string(self::ENDS_AT)->toString()),
        );
    }
}
