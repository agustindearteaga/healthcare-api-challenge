<?php

declare(strict_types=1);

namespace Lightit\Clinics\Domain\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Lightit\Clinics\Domain\Models\Clinic;
use Spatie\QueryBuilder\QueryBuilder;

class ListClinicAction
{
    /**
     * @return LengthAwarePaginator<int, \Lightit\Clinics\Domain\Models\Clinic>
     */
    public function execute(): LengthAwarePaginator
    {
        return QueryBuilder::for(Clinic::class)
            ->allowedFilters(['name'])
            ->allowedSorts('name', 'address')
            ->orderBy('id', 'desc')
            ->paginate();
    }
}

