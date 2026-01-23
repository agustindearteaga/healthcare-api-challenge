<?php

declare(strict_types=1);

namespace Lightit\Appointments\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Appointments\Domain\Models\Appointment;

final readonly class DeleteAppointmentController
{
    public function __invoke(Appointment $appointment): JsonResponse
    {
        $appointment->deleteOrFail();

        return response()->json(status: JsonResponse::HTTP_NO_CONTENT);
    }
}
