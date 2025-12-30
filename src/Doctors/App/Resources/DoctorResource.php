<?php

declare(strict_types=1);

namespace Lightit\Doctors\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Dedoc\Scramble\Attributes\SchemaName;
use Illuminate\Http\Request;

#[SchemaName('Doctor')]
class DoctorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
