<?php namespace Source\DataGrid;

use Illuminate\Database\Query\Builder as Query;
use Source\DataGrid\View\Builder as ViewBuilder;

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
     * Builds the DataGrid.
     */
    public function make()
    {
        // Build everything
        $this->builder->buildQuery();

        var_dump($this->builder->getQueryBuilder()->getQuery()->toSql());

        return $this->getView();
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

    /**
     * Returns the whole DataGrid view.
     *
     * @return \Illuminate\View\View
     */
    protected function getView(){
        return (new ViewBuilder)->setDataForGrid([
            'columns' => $this->builder->getQueryBuilder()->getColumns(),
            'data' => $this->builder->getQueryBuilder()->getResults(),
        ])->build();
    }

}
