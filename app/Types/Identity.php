<?php

namespace App\Types;

use App\Contracts\Type;
use Illuminate\Support\Facades\Validator;

class Identity extends Type
{

    const TYPE_EMAIL = 'email';

    const TYPE_USERNAME = 'username';

    const TYPE_API_KEY = 'api_key';

    private string $value;

    private string $type;


    public function __construct(string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function getType(str)
    {

    }

    public static function validateEmail(string $value): bool
    {
        return Validator::make(['email' => $value],['email' => 'require|email:rfc,dns'])->passes();
    }

    public static function validatePilotId(string $value): bool
    {
        return Validator::make(['pilot_id' => $value], ['pilot_id' => 'required|integer|exists:App\Models\User,pilot_id'])->passes();
    }

    public static function validateApiKey(string $value): bool
    {
        return Validator::make(['api_key' => $value], ['api_key' => 'required|string|exists:App\Models\User,api_key'])->passes();
    }

}
