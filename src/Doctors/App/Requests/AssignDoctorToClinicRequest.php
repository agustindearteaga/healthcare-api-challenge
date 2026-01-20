<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Clinics\Domain\Models\Clinic;
use Lightit\Doctors\Domain\DataTransferObjects\AssignDoctorToClinicDto;

final class AssignDoctorToClinicRequest extends FormRequest
{
    public const string CLINIC_IDS = 'clinic_ids';
    
    public function rules(): array
    {
        return [
            self::CLINIC_IDS => ['required', 'array', 'min: 1'],
            self::CLINIC_IDS . '.*' => ['required', Rule::exists(Clinic::class, 'id')],
        ];
    }

    public function toDto(): AssignDoctorToClinicDto
    {
        /** @var array<int, int> $clinicIds */
        $clinicIds = $this->validated(self::CLINIC_IDS) ?? [];

        return new AssignDoctorToClinicDto(
            clinicIds: array_map(
                static fn (int|string $id): int => $id,
                $clinicIds
            )
        );
    }
}
