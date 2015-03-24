<?php namespace Source\DataGrid;

use Illuminate\Database\Query\Builder as Query;

/**
 * DataGrid main class.
 *
 * @package Source\DataGrid
 */
class DataGrid
{

    /**
     * @var Builder
     */
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Query builder setter.
     *
     * @param Query $query
     * @return $this
     */
    public function query(Query $query)
    {
        $this->builder->setQuery($query);

        return $this;
    }

    /**
     * Query limit setter.
     *
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit = null)
    {
        $this->builder->getQueryBuilder()->setLimit((int)$limit);

        return $this;
    }

    /**
     * Builds the query.
     */
    public function make()
    {
        $this->builder->buildQuery();

        var_dump($this->builder->getQueryBuilder()->getQuery()->toSql());

        return \View::make('data_grid.data_grid');
    }

    /**
     * Registers a query filter.
     *
     * @param string $field Field (table column) name.
     * @param callable $query
     * @return $this
     */
    public function filter($field, callable $query)
    {
        $this->builder->getQueryBuilder()->setFilter($field, $query);

        return $this;
    }

}
