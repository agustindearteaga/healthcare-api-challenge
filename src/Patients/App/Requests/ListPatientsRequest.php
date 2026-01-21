<?php

declare(strict_types=1);

namespace Lightit\Patients\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ListPatientsRequest extends FormRequest
{
    public const string PAGE = 'page';

    public const string PER_PAGE = 'per_page';

    public const int DEFAULT_ITEMS_PER_PAGE = 15;

    public const int STARTING_PAGE = 1;

    public function rules(): array
    {
        return [
            self::PAGE => ['sometimes', 'integer', 'min:1'],
            self::PER_PAGE => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function pageNumber(): int
    {
        return $this->integer(self::PAGE, self::STARTING_PAGE);
    }

    public function itemsPerPage(): int
    {
        return $this->integer(self::PER_PAGE, self::DEFAULT_ITEMS_PER_PAGE);
    }
}
