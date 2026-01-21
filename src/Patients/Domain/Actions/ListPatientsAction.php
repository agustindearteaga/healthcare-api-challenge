<?php

declare(strict_types=1);

namespace Lightit\Patients\Domain\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Lightit\Patients\Domain\Models\Patient;
use Spatie\QueryBuilder\QueryBuilder;

final class ListPatientsAction
{
    /**
     * @return LengthAwarePaginator<int, Patient>
     */
    public function execute(int $pageNumber, int $itemsPerPage): LengthAwarePaginator
    {
        return QueryBuilder::for(Patient::class)
            ->allowedFilters(['first_name', 'last_name', 'email'])
            ->allowedSorts('first_name', 'last_name', 'email')
            ->orderBy('id', 'desc')
            ->paginate(
                perPage: $itemsPerPage,
                page: $pageNumber,
            );
    }
}
