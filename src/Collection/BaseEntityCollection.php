<?php

namespace Willydamtchou\SymfonyUtilities\Collection;

use Willydamtchou\SymfonyUtilities\Model\BaseObject;
use Willydamtchou\SymfonyUtilities\Model\BaseEntity;

class BaseEntityCollection extends Collection
{
    /**
     * @param object|array<BaseEntity> $array
     * @param string $entityClass
     * @param int $flags
     * @param string $iteratorClass
     */
    public function __construct(
        object|array $array = [],
        string $entityClass = BaseEntity::class,
        int $flags = 0,
        string $iteratorClass = self::ARRAY_ITERATOR
    ) {
        parent::__construct($array, $entityClass, $flags, $iteratorClass);
    }

    /**
     * @param BaseEntity|BaseObject $value
     *
     * @return void
     */
    public function add(BaseEntity|BaseObject $value): void
    {
        parent::add($value);
    }

    /**
     * @param int|string $key
     *
     * @return BaseEntity|BaseObject
     */
    public function get(int|string $key): BaseEntity|BaseObject
    {
        return parent::get($key);
    }
}
