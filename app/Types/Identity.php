<?php

namespace App\Types;

use App\Contracts\Type;
use App\Exceptions\InvalidIdentity;
use Illuminate\Support\Facades\Validator;

class Identity implements Type
{
    const TYPE_EMAIL = 'email';

    const TYPE_PILOT_ID = 'pilot_id';

    const TYPE_API_KEY = 'api_key';

    private string $value;

    private string $type;

    public function __construct(string $value)
    {
        $this->type = self::getType($value);
        $this->value = $value;
    }

    public static function getType(string $value): string
    {
        if(self::validateEmail($value))
            return self::TYPE_EMAIL;

        if(self::validatePilotId($value))
            return self::TYPE_PILOT_ID;

        if(self::validateApiKey($value))
            return self::TYPE_API_KEY;

        throw new InvalidIdentity();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function __toArray(): array
    {
        return [
            'type' => $this->type,
            'value' => $this->value
        ];
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
