<?php

declare(strict_types=1);

namespace Lightit\Appointments\Domain\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Lightit\Appointments\Domain\Models\Appointment;
use Spatie\QueryBuilder\QueryBuilder;

final class ListAppointmentsAction
{
    /**
     * @return LengthAwarePaginator<int, Appointment>
     */
    public function execute(int $pageNumber, int $itemsPerPage): LengthAwarePaginator
    {
        return QueryBuilder::for(Appointment::class)
            ->allowedFilters(['doctor_id', 'patient_id', 'clinic_id', 'starts_at', 'ends_at'])
            ->allowedSorts('doctor_id', 'patient_id', 'clinic_id', 'starts_at', 'ends_at')
            ->orderBy('id', 'desc')
            ->paginate(
                perPage: $itemsPerPage,
                page: $pageNumber,
            );
    }
}
