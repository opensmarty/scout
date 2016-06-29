<?php

namespace Laravel\Scout\Engines;

use Laravel\Scout\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class Engine
{
    /**
     * Update the given model in the index.
     *
     * @param  Collection  $models
     * @return void
     */
    abstract public function update($models);

    /**
     * Remove the given model from the index.
     *
     * @param  Collection  $models
     * @return void
     */
    abstract public function delete($models);

    /**
     * Perform the given search on the engine.
     *
     * @param  Builder  $query
     * @return mixed
     */
    abstract public function search(Builder $builder);

    /**
     * Perform the given search on the engine.
     *
     * @param  Builder  $query
     * @param  int  $perPage
     * @param  int  $page
     * @return mixed
     */
    abstract public function paginate(Builder $builder, $perPage, $page);

    /**
     * Map the given results to instances of the given model.
     *
     * @param  mixed  $results
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return Collection
     */
    abstract public function map($results, $model);

    /**
     * Get the results of the given query mapped onto models.
     *
     * @param  Builder  $builder
     * @return Collection
     */
    public function get(Builder $query)
    {
        return Collection::make($this->map(
            $this->search($query), $query->model
        ));
    }
}
