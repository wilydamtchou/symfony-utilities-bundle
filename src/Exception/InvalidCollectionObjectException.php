<?php

namespace Willydamtchou\SymfonyUtilities\Exception;

use Willydamtchou\SymfonyUtilities\Model\AppMessage;

class InvalidCollectionObjectException extends GeneralException
{
    protected string $exceptionCode = '02';
    protected ?string $userMessage = 'Verify the data of your operation';

    /**
     * @param string $variableClass
     * @param string $entityClass
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $variableClass,
        string $entityClass,
        string $message = AppMessage::INVALID_COLLECTION_OBJECT[self::MESSAGE],
        int $code = AppMessage::INVALID_COLLECTION_OBJECT[self::CODE],
        \Throwable $previous = null
    ) {
        parent::__construct(
            sprintf(
                $message,
                $variableClass,
                $entityClass
            ),
            $code,
            $previous
        );
    }
}
