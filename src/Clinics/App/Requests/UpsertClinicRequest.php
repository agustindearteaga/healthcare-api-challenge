<?php

declare(strict_types=1);

namespace Lightit\Clinics\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Clinics\Domain\DataTransferObjects\ClinicDto;

class UpsertClinicRequest extends FormRequest
{
    public const string NAME = 'name';

    public const string ADDRESS = 'address';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:50'],
            self::ADDRESS => ['required', 'string', 'max:100'],
        ];
    }

    public function toDto(): ClinicDto
    {
        return new ClinicDto(
            $this->string(self::NAME)->toString(),
            $this->string(self::ADDRESS)->toString());
    }
}
