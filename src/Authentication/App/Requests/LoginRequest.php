<?php

declare(strict_types=1);

namespace Lightit\Authentication\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Lightit\Authentication\Domain\DataTransferObjects\CredentialsDto;

class LoginRequest extends FormRequest
{
    public const EMAIL = 'email';

    public const PASSWORD = 'password';

    public function rules(): array
    {
        return [
            self::EMAIL => ['required', Rule::email()->strict()],
            self::PASSWORD => ['required', Password::defaults()],
        ];
    }

    public function toDto(): CredentialsDto
    {
        return new CredentialsDto(
            email: $this->string(self::EMAIL)->toString(),
            password: $this->string(self::PASSWORD)->toString(),
        );
    }
}
