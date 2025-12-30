<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Controllers;

use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Lightit\Doctors\App\Resources\DoctorResource;
use Lightit\Doctors\Domain\Actions\GetDoctorAction;
use Lightit\Doctors\Domain\Models\Doctor;

#[Group('Doctors')]
final readonly class GetDoctorController
{
    public function __invoke(Doctor $doctor, GetDoctorAction $getDoctorAction): JsonResponse
    {
        $doctor = $getDoctorAction->execute($doctor);

        return DoctorResource::make($doctor)
            ->response();
    }
}
