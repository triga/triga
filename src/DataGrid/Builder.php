<?php namespace Source\DataGrid;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder as Query;
use Source\DataGrid\Query\Builder as QueryBuilder;

/**
 * DataGrid builder, responsible for binding everything and making it work together.
 *
 * @package Source\DataGrid
 */
class Builder
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    public function __construct(Request $request, QueryBuilder $queryBuilder)
    {
        $this->request = $request;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Query setter.
     *
     * @param Query $query
     */
    public function setQuery(Query $query)
    {
        $this->queryBuilder->setQuery($query);
    }

    /**
     * Builds the query.
     */
    public function buildQuery()
    {
        $this->queryBuilder
            ->setSortingColumn($this->request->get('order_by'))
            ->setSortingDirection($this->request->get('order_dir'))
            ->setOffset($this->request->get('page'));

        $this->applyFilters();
    }

    /**
     * Applies the filters.
     */
    protected function applyFilters()
    {
        // Get the registered filters from the query builder.
        foreach ($this->queryBuilder->getFilters() as $field => $filter) {

            // Get the field value from the request
            $request_value = $this->request->get($field);

            // If the value is set, apply the filter
            if ($request_value) {
                $this->queryBuilder->applyFilter($field, $request_value);
            }
        }
    }

    /**
     * Returns the QueryBuilder instance.
     *
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

}