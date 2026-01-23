<?php

declare(strict_types=1);

namespace Lightit\Appointments\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Appointments\App\Requests\ListAppointmentsRequest;
use Lightit\Appointments\App\Resources\AppointmentResource;
use Lightit\Appointments\Domain\Actions\ListAppointmentsAction;

final readonly class ListAppointmentsController
{
    public function __invoke(ListAppointmentsRequest $request, ListAppointmentsAction $listAppointmentsAction): JsonResponse
    {
        $appointments = $listAppointmentsAction->execute(
            pageNumber: $request->pageNumber(),
            itemsPerPage: $request->itemsPerPage(),
        );

        return AppointmentResource::collection($appointments)->response();
    }
}
