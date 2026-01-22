<?php

declare(strict_types=1);

namespace Lightit\Clinics\App\Controllers;

use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Lightit\Clinics\App\Resources\ClinicResource;
use Lightit\Clinics\App\Requests\ListClinicsRequest;
use Lightit\Clinics\Domain\Actions\ListClinicsAction;

#[Group('Clinics')]
final class ListClinicsController
{
    public function __invoke(
        ListClinicsRequest $request,
        ListClinicsAction $action,
    ): JsonResponse {
        $clinics = $action->execute($request->pageNumber(), $request->itemsPerPage());

        return ClinicResource::collection($clinics)
            ->response();
    }
}
