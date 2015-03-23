<?php namespace Source\DataGrid;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

/**
 * DataGrid main class.
 *
 * @package Source\DataGrid
 */
class DataGrid
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * @var int Query limit.
     */
    private $limit = 20;

    /**
     * @var array Filters to be applied to the query.
     */
    private $filters = [];

    public function __construct(Request $request, QueryBuilder $queryBuilder)
    {
        $this->request = $request;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Query builder setter.
     *
     * @param Builder $query
     * @return $this
     */
    public function query(Builder $query)
    {
        $this->queryBuilder->setQuery($query);

        return $this;
    }

    /**
     * Query limit setter.
     *
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit = 20)
    {
        $this->limit = (int)$limit;

        return $this;
    }

    /**
     * Builds the query.
     */
    public function make()
    {
        $this->queryBuilder
            ->setSortingColumn($this->request->get('order_by'))
            ->setSortingDirection($this->request->get('order_dir'))
            ->setOffset($this->request->get('page'), $this->limit)
            ->setLimit($this->limit);

        $this->applyFilters();

        return \View::make('data_grid.data_grid');

        $query = $this->queryBuilder->getQuery();
        var_dump($query->toSql());
        die;
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
        $this->filters[$field] = $query;

        return $this;
    }

    /**
     * Apples the filters.
     */
    protected function applyFilters()
    {
        foreach ($this->filters as $field => $filter) {
            $request_value = $this->request->get($field);

            if ($request_value) {
                $filter($this->queryBuilder->getRawQuery(), $request_value);
            }
        }
    }
}
