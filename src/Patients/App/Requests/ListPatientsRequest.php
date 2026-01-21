<?php

declare(strict_types=1);

namespace Lightit\Patients\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ListPatientsRequest extends FormRequest
{
    public const string PAGE = 'page';
    public const string PER_PAGE = 'per_page';

    public function rules(): array
    {
        return [
            self::PAGE => ['sometimes', 'integer', 'min:1'],
            self::PER_PAGE => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function pageNumber(): int
    {
        return (int) $this->input(self::PAGE, 1);
    }

    public function itemsPerPage(): int
    {
        return (int) $this->input(self::PER_PAGE, 15);
    }
}
