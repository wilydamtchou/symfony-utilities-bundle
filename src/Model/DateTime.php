<?php

namespace Willydamtchou\SymfonyUtilities\Model;

class DateTime extends \DateTime
{
    public const string TIME_ZONE = 'UCT';
    public const string FORMAT = 'Y-m-d H:i:s';
    public const string NOW = 'now';

    /**
     * @param string $datetime
     * @param \DateTimeZone|null $timezone
     *
     * @throws \Exception
     */
    public function __construct(
        string $datetime = self::NOW,
        \DateTimeZone|null $timezone = new \DateTimeZone(self::TIME_ZONE)
    ) {
        parent::__construct($datetime, $timezone);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return parent::format(self::FORMAT);
    }

    /**
     * @param string $format
     * @param string $datetime
     * @param \DateTimeZone|null $timezone
     *
     * @return DateTime|false
     */
    public static function createFromFormat(
        string $datetime,
        string $format = self::FORMAT,
        \DateTimeZone|null $timezone = new \DateTimeZone(self::TIME_ZONE)
    ): DateTime|false {
        return parent::createFromFormat(
            $format,
            $datetime,
            $timezone
        );
    }
}
