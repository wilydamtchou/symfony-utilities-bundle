<?php

namespace Willydamtchou\SymfonyUtilities\Model;

abstract class BaseObject implements BaseObjectInterface
{
    public const string NAME = 'name';
    public const string GET = 'get';
    public const string SET = 'set';

    /**
     * @param array<string, mixed> $attributes
     * @param array<string, mixed> $excludeAttributes
     *
     * @throws \ReflectionException
     */
    public function hydrate(array $attributes, array $excludeAttributes = []): void
    {
        $reflect = new \ReflectionClass($this);

        $methods = $reflect->getMethods(\ReflectionMethod::IS_PUBLIC);
        $properties = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($methods as $method) {
            if (!str_starts_with($method->getName(), self::SET)) {
                continue;
            } elseif (1 != $method->getNumberOfParameters()) {
                continue;
            }

            $key = lcfirst(str_replace(self::SET, '', $method->getName()));

            if (in_array($key, $excludeAttributes)) {
                continue;
            } elseif (!array_key_exists($key, $attributes) || !$attributes[$key]) {
                continue;
            } elseif (!property_exists($this, $key)) {
                continue;
            }

            $method->invoke($this, $attributes[$key]);
        }

        foreach ($properties as $property) {
            if ($property->isReadOnly()) {
                continue;
            }

            $prop = $property->getName();

            if (
                !property_exists($this, $prop) ||
                !array_key_exists($prop, $attributes) ||
                !$attributes[$prop]
            ) {
                continue;
            }

            $this->$prop = $attributes[$prop];
        }
    }

    /**
     * @return array<string, mixed>
     *
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        $reflect = new \ReflectionClass($this);

        $methods = $reflect->getMethods(\ReflectionMethod::IS_PUBLIC);
        $properties = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

        $object = [];

        foreach ($methods as $method) {
            if (!str_starts_with($method->getName(), self::GET)) {
                continue;
            } elseif (0 != $method->getNumberOfParameters()) {
                continue;
            }

            $key = lcfirst(str_replace(self::GET, '', $method->getName()));

            if (!property_exists($this, $key)) {
                continue;
            }

            $object[$key] = $method->invoke($this);
        }

        foreach ($properties as $property) {
            $prop = $property->getName();

            if (!property_exists($this, $prop)) {
                continue;
            }

            $object[$prop] = $this->$prop ?? null;
        }

        return $object;
    }

    /**
     * @return string
     *
     * @throws \ReflectionException
     */
    public function __toString(): string {
        return $this->toString();
    }

    /**
     * @return string
     *
     * @throws \ReflectionException
     */
    public function toString(): string {
        return json_encode($this->toArray());
    }
}
