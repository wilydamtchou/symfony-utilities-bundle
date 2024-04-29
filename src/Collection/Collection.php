<?php

namespace Willydamtchou\SymfonyUtilities\Collection;

use Willydamtchou\SymfonyUtilities\Exception\InvalidCollectionObjectException;
use Willydamtchou\SymfonyUtilities\Model\BaseObject;

/**
 * @template-extends \ArrayObject<int, BaseObject>
 */
class Collection extends \ArrayObject
{
    public const string ARRAY_ITERATOR = 'ArrayIterator';

    protected string $entityClass = BaseObject::class;

    /**
     * @param object|array<BaseObject> $array
     * @param string $entityClass
     * @param int $flags
     * @param string $iteratorClass
     */
    public function __construct(
        object|array $array = [],
        string $entityClass = BaseObject::class,
        int $flags = 0,
        string $iteratorClass = self::ARRAY_ITERATOR
    ) {
        $newArray = [];

        foreach ($array as $value) {
            if (get_class($value) != $entityClass  && !is_subclass_of($entityClass, get_class($value))) {
                continue;
            }
            $newArray[] = $value;
        }

        parent::__construct(
            $newArray,
            $flags,
            $iteratorClass
        );

        $this->entityClass = $entityClass;
    }

    /**
     * @param BaseObject $value
     *
     * @return void
     */
    public function add(BaseObject $value): void
    {
        if (get_class($value) != $this->entityClass && !is_subclass_of(get_class($value), $this->entityClass)) {
            throw new InvalidCollectionObjectException(get_class($value), $this->entityClass);
        }

        parent::append($value);
    }

    /**
     * @param int|string $key
     *
     * @return BaseObject
     */
    public function get(int|string $key): BaseObject
    {
        return $this->getArrayCopy()[$key];
    }

    /**
     * @return array<BaseObject>
     */
    public function getAll(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->count() <= 0;
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return $this->toString();
    }

    /**
     * @return string
     */
    public function toString(): string {
        return json_encode($this->getAll());
    }
}
