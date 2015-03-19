<?php namespace Source\DataGrid;

use Illuminate\Database\Query\Builder;

class QueryBuilder
{
    const SORT_DIR_ASC = 'asc';
    const SORT_DIR_DESC = 'desc';

    /**
     * @var Builder
     */
    private $query;
    private $sortBy;
    private $sortDir;
    private $offset;
    private $limit;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function setSortingColumn($sortBy = null)
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    public function setSortingDirection($sortDir = null)
    {
        $sortDir = strtolower($sortDir);

        if (false === in_array($sortDir, [self::SORT_DIR_ASC, self::SORT_DIR_DESC])) {
            $sortDir = null;
        }

        $this->sortDir = $sortDir;

        return $this;
    }

    public function setOffset($page = null, $limit = null)
    {
        $this->offset = (int)$page * (int)$limit;

        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = (int)$limit;

        return $this;
    }

    public function getQuery()
    {
        $this->makeSorting()
            ->makeLimit();

        return $this->query;
    }

    protected function makeSorting(){
        if ($this->sortBy && $this->sortDir) {
            $this->query->orderBy($this->sortBy, $this->sortDir);
        }

        return $this;
    }

    protected function makeLimit(){
        $this->query->take($this->limit);

        if ($this->offset) {
            $this->query->skip($this->offset);
        }

        return $this;
    }
}
