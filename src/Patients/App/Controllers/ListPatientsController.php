<?php

declare(strict_types=1);

namespace Lightit\Patients\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Patients\App\Requests\ListPatientsRequest;
use Lightit\Patients\App\Resources\PatientResource;
use Lightit\Patients\Domain\Actions\ListPatientsAction;

final readonly class ListPatientsController
{
    public function __invoke(ListPatientsRequest $request, ListPatientsAction $listPatientsAction): JsonResponse
    {
        $patients = $listPatientsAction->execute(
            pageNumber: $request->pageNumber(),
            itemsPerPage: $request->itemsPerPage(),
        );

        return PatientResource::collection($patients)->response();
    }
}
