<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertDoctorRequest extends FormRequest
{
    public const string NAME = 'name';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:50'],
        ];
    }

    public function getName(): string
    {
        return $this->string(self::NAME)->toString();
    }
}
