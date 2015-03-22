<?php namespace Source\DataGrid;

use Illuminate\Database\Query\Builder;

/**
 * DataGrid query builder. Responsible for building the query to be executed.
 *
 * @package Source\DataGrid
 */
class QueryBuilder
{
    const SORT_DIR_ASC = 'asc';
    const SORT_DIR_DESC = 'desc';

    /**
     * @var Builder
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
    private $limit;

    /**
     * Query setter.
     *
     * @param Builder $query
     * @return $this
     */
    public function setQuery(Builder $query)
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
     * @param int|null $limit
     * @return $this
     */
    public function setOffset($page = null, $limit = null)
    {
        $this->offset = (int)$page * (int)$limit;

        return $this;
    }

    /**
     * Query limit setter.
     *
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = (int)$limit;

        return $this;
    }

    /**
     * Builds and returns the query.
     *
     * @return Builder
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
     * @return Builder
     */
    public function getRawQuery()
    {
        return $this->query;
    }
}
