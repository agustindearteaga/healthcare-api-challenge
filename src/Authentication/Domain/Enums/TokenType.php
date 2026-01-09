<?php

declare(strict_types=1);

namespace Lightit\Authentication\Domain\Enums;

enum TokenType: string
{
    case Bearer = 'Bearer';
}
