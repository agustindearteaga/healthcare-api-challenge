<?php

declare(strict_types=1);

namespace Lightit\Clinics\Domain\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Lightit\Clinics\Domain\Models\Clinic;
use Spatie\QueryBuilder\QueryBuilder;

class ListClinicsAction
{
    /**
     * @return LengthAwarePaginator<int, Clinic>
     */
    public function execute(int $pageNumber, int $itemsPerPage): LengthAwarePaginator
    {
        return QueryBuilder::for(Clinic::class)
            ->allowedFilters(['name'])
            ->allowedSorts('name', 'address')
            ->withCount('doctors as doctors_count')
            ->orderBy('id', 'desc')
            ->paginate(
                perPage: $itemsPerPage,
                page: $pageNumber,
            );
    }
}
