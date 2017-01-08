<?php

namespace AMP\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all(array $columns = ['*']): Collection;

    public function create(array $data): Model;

    public function update(array $data, int $id): bool;

    public function delete(int $id): bool;

    public function find(int $id, array $columns = ['*']): Model;

    public function findOneBy(string $field, string $value, array $columns = ['*']): Builder;

    public function findBy(string $field, string $value, array $columns = ['*']): Collection;
}