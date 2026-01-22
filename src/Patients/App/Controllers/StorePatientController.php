<?php

declare(strict_types=1);

namespace Lightit\Patients\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Patients\App\Requests\UpsertPatientRequest;
use Lightit\Patients\App\Resources\PatientResource;
use Lightit\Patients\Domain\Actions\UpsertPatientAction;

final readonly class StorePatientController
{
    public function __invoke(UpsertPatientRequest $request, UpsertPatientAction $upsertPatientAction): JsonResponse
    {
        $patient = $upsertPatientAction->execute($request->toDto());

        return PatientResource::make($patient)
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
