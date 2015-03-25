<?php namespace Source\DataGrid\Query;

use Illuminate\Database\Query\Builder as Query;

/**
 * DataGrid query builder. Responsible for building the query to be executed.
 *
 * @package Source\DataGrid\Query
 */
class Builder
{
    const SORT_DIR_ASC = 'asc';
    const SORT_DIR_DESC = 'desc';

    /**
     * @var Query
     */
    private $query;

    /**
     * @var string Sorting column.
     */
    private $sortBy;

    /**
     * @var string Sorting direction.
     */
    private $sortDir;

    /**
     * @var int Query offset.
     */
    private $offset;

    /**
     * @var int Query limit.
     */
    private $limit = 20;

    /**
     * @var array Filters to be applied to the query.
     */
    private $filters = [];

    /**
     * Query setter.
     *
     * @param Query $query
     * @return $this
     */
    public function setQuery(Query $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Sorting column setter.
     *
     * @param string|null $sortBy
     * @return $this
     */
    public function setSortingColumn($sortBy = null)
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    /**
     * Sorting direction setter.
     *
     * @param string|null $sortDir
     * @return $this
     */
    public function setSortingDirection($sortDir = null)
    {
        $sortDir = strtolower($sortDir);

        if (false === in_array($sortDir, [self::SORT_DIR_ASC, self::SORT_DIR_DESC])) {
            $sortDir = null;
        }

        $this->sortDir = $sortDir;

        return $this;
    }

    /**
     * Offset setter.
     *
     * @param int|null $page
     * @return $this
     */
    public function setOffset($page = null)
    {
        $this->offset = (int)$page * (int)$this->limit;

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
     * Builds and returns the query.
     *
     * @return Query
     */
    public function getQuery()
    {
        $this->makeSorting()
            ->makeLimit();

        return $this->query;
    }

    /**
     * Sets the sorting in the query.
     *
     * @return $this
     */
    protected function makeSorting()
    {
        if ($this->sortBy && $this->sortDir) {
            $this->query->orderBy($this->sortBy, $this->sortDir);
        }

        return $this;
    }

    /**
     * Sets the limit in the query.
     *
     * @return $this
     */
    protected function makeLimit()
    {
        $this->query->take($this->limit);

        if ($this->offset) {
            $this->query->skip($this->offset);
        }

        return $this;
    }

    /**
     * Query getter.
     *
     * @return Query
     */
    public function getRawQuery()
    {
        return $this->query;
    }

    /**
     * Registers a query filter.
     *
     * @param string $field Field (table column) name.
     * @param callable $query
     * @return $this
     */
    public function setFilter($field, callable $query)
    {
        $this->filters[$field] = $query;

        return $this;
    }

    /**
     * Returns registered filters;
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Applies a filter to the query with the given field value.
     *
     * @param string $field
     * @param mixed $value
     */
    public function applyFilter($field, $value)
    {
        $this->filters[$field]($this->query, $value);
    }

    /**
     * Returns an array of columns fetched by the query.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->query->columns;
    }
}
