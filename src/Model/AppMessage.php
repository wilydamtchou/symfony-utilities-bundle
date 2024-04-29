<?php

namespace Willydamtchou\SymfonyUtilities\Model;

interface AppMessage extends SystemMessage
{
    public const array GENERAL_FAILURE = [
        self::CODE => 500,
        self::MESSAGE => 'System general error',
    ];

    public const array INVALID_COLLECTION_OBJECT = [
        self::CODE => 509,
        self::MESSAGE => 'The value of class %s cannot be added in collection because this value is not of class %s',
    ];
}
