<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Controllers;

use Dedoc\Scramble\Attributes\Group;
use Lightit\Doctors\App\Requests\UpsertDoctorRequest;
use Illuminate\Http\JsonResource;
use Illuminate\Http\JsonResponse;
use Lightit\Doctors\App\Resources\DoctorResource;
use Lightit\Doctors\Domain\Actions\CreateDoctorAction;

#[Group('Doctors')]
final readonly class CreateDoctorController
{
    public function __invoke(UpsertDoctorRequest $request, CreateDoctorAction $createDoctorAction): JsonResponse
    {
        $doctor = $createDoctorAction->execute($request->toDto());

        return DoctorResource::make($doctor)
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
