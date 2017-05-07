<?php

namespace AMP\Repository;

use Exception;
use Illuminate\Contracts\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Repository
 *
 * @package AMP\Repository
 *
 * @TODO    : Clean up. I am not happy with this.
 */
abstract class Repository implements RepositoryInterface
{
    /** @var  Builder */
    protected $model;
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model(): string;

    public function makeModel(): Builder
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception('Class ' . $this->model() . ' must be an instance of Illuminate\Database\Eloquent\Model.');
        }

        return $this->model = $model->newQuery();
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): bool
    {
        return $this->model->find($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    public function find(int $id, array $columns = ['*']): Model
    {
        return $this->model->find($id, $columns);
    }

    public function findOneBy(string $field, string $value, array $columns = ['*']): Builder
    {
        return $this->model->where($field, '=', $value)->first($columns);
    }

    public function findBy(string $field, string $value, array $columns = ['*']): Collection
    {
        return $this->model->where($field, '=', $value)->get($columns);
    }

    public function save(Model $model)
    {
        $model->save();
    }
}