<?php

declare(strict_types=1);

namespace Lightit\Patients\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Patients\Domain\DataTransferObjects\PatientDto;
use Lightit\Patients\Domain\Models\Patient;

final class UpsertPatientRequest extends FormRequest
{
    public const string FIRST_NAME = 'first_name';

    public const string LAST_NAME = 'last_name';

    public const string EMAIL = 'email';

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Patient|null $patient */
        $patient = $this->route('patient');

        return [
            self::FIRST_NAME => ['required', 'string', 'max:50'],
            self::LAST_NAME => ['required', 'string', 'max:50'],
            self::EMAIL => [
                'required',
                'string',
                'max:100',
                Rule::email()->strict(),
                Rule::unique(Patient::class, 'email')->ignore($patient?->id),
            ],
        ];
    }

    public function toDto(): PatientDto
    {
        return new PatientDto(
            firstName: $this->string(self::FIRST_NAME)->toString(),
            lastName: $this->string(self::LAST_NAME)->toString(),
            email: $this->string(self::EMAIL)->toString(),
        );
    }
}
