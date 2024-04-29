<?php

namespace Willydamtchou\SymfonyUtilities\Model;

interface BaseObjectInterface
{
    /**
     * @param array<string, mixed> $attributes
     * @param array<string, mixed> $excludeAttributes
     *
     * @throws \ReflectionException
     */
    public function hydrate(array $attributes, array $excludeAttributes = []): void;

    /**
     * @return array<string, mixed>
     *
     * @throws \ReflectionException
     */
    public function toArray(): array;
}
