<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Controllers;

use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Lightit\Doctors\App\Requests\UpsertDoctorRequest;
use Lightit\Doctors\App\Resources\DoctorResource;
use Lightit\Doctors\Domain\Actions\UpsertDoctorAction;

#[Group('Doctors')]
final readonly class StoreDoctorController
{
    public function __invoke(UpsertDoctorRequest $request, UpsertDoctorAction $upsertDoctorAction): JsonResponse
    {
        $doctorName = $request->string(UpsertDoctorRequest::NAME)->toString();
        $doctor = $upsertDoctorAction->execute(null, $doctorName);

        return DoctorResource::make($doctor)
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
