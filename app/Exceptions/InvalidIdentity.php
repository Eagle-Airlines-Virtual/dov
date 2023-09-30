<?php

namespace App\Exceptions;

class InvalidIdentity extends AbstractHttpException
{
    public function __construct()
    {
        parent::__construct(
            400,
            'Invalid Identity'
        );
    }

    /**
     * Return the RFC 7807 error type (without the URL root)
     */
    public function getErrorType(): string
    {
        return 'Bad Request';
    }

    /**
     * Get the detailed error string
     */
    public function getErrorDetails(): string
    {
        return $this->getMessage();
    }

    /**
     * Return an array with the error details, merged with the RFC7807 response
     */
    public function getErrorMetadata(): array
    {
        return [];
    }
}
