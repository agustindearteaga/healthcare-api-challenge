<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Controllers;

use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Lightit\Doctors\App\Requests\UpsertDoctorRequest;
use Lightit\Doctors\App\Resources\DoctorResource;
use Lightit\Doctors\Domain\Actions\StoreDoctorAction;

#[Group('Doctors')]
final readonly class StoreDoctorController
{
    public function __invoke(UpsertDoctorRequest $request, StoreDoctorAction $storeDoctorAction): JsonResponse
    {
        $doctorName = $request->string(UpsertDoctorRequest::NAME)->toString();
        $doctor = $storeDoctorAction->execute($doctorName);

        return DoctorResource::make($doctor)
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
