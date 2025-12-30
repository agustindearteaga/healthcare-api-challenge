<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Doctors\Domain\Models\Doctor;

class DeleteDoctorController
{
    public function __invoke(Doctor $doctor): JsonResponse
    {
        $doctor->delete();

        return response()->json(status: JsonResponse::HTTP_NO_CONTENT);
    }
}
