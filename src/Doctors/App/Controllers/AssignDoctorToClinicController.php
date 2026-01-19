<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Doctors\App\Requests\AssignDoctorToClinicRequest;
use Lightit\Doctors\App\Resources\DoctorResource;
use Lightit\Doctors\Domain\Actions\AssignDoctorToClinicAction;
use Lightit\Doctors\Domain\Models\Doctor;

final class AssignDoctorToClinicController
{
    public function __invoke(
        Doctor $doctor,
        AssignDoctorToClinicRequest $request,
        AssignDoctorToClinicAction $assignDoctorToClinicAction,
    ): JsonResponse {
        $doctor = $assignDoctorToClinicAction->execute($doctor, $request->toDto());

        return DoctorResource::make($doctor)
        ->response()
        ->setStatusCode(JsonResponse::HTTP_OK);
    }
}
