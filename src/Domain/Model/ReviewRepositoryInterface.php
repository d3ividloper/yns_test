<?php

namespace App\Domain\Model;

interface ReviewRepositoryInterface
{
    /**
     * @return array
     */
    public function list(): array;

    /**
     * @param Review $entity
     */
    public function save(Review $entity);

    /**
     * @param Review $entity
     */
    public function remove(Review $entity): void;
}
