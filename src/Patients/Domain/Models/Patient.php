<?php

declare(strict_types=1);

namespace Lightit\Patients\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = ['id'];
}