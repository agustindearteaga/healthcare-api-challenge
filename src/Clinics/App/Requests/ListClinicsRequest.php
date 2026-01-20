<?php

declare(strict_types=1);

namespace Lightit\Clinics\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListClinicsRequest extends FormRequest
{
    public const PAGE = 'page';
    public const PER_PAGE = 'per_page';

    public function rules(): array
    {
        return [
            self::PAGE => ['sometimes', 'integer', 'min:1'],
            self::PER_PAGE => ['sometimes', 'integer', 'min:1', Rule::max(100)],
        ];
    }

    public function pageNumber(): int
    {
        $validatedData = $this->validated();

        return $validatedData[self::PAGE] ?? 1;
    }

    public function itemsPerPage(): int
    {
        $validatedData = $this->validated();
        return $validatedData[self::PER_PAGE] ?? 15;
    }
}