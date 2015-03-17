<?php namespace Source\DataGrid;

class QueryBuilder
{

    const SORT_DIR_ASC = 'ASC';
    const SORT_DIR_DESC = 'DESC';

    /**
     * @var array
     */
    private $columns;
    private $table;
    private $sortBy;
    private $sortDir;

    public function __construct(array $columns, $table)
    {
        $this->columns = $columns;
        $this->table = $table;
    }

    public function getQuery()
    {
        $query = sprintf('SELECT %s FROM %s', join(',', $this->columns), $this->table);

        if (false === empty($this->sortBy) && false === empty($this->sortDir)) {
            $query .= sprintf(' ORDER BY %s %s', $this->sortBy, strtoupper($this->sortDir));
        }

        return $query;
    }

    public function setSortingColumn($sortBy)
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    public function setSortingDirection($sortDir)
    {
        $dir = strtoupper($sortDir);

        if (false === in_array($dir, [self::SORT_DIR_ASC, self::SORT_DIR_DESC])) {
            throw new \InvalidArgumentException('Incorrect sorting direction.');
        }

        $this->sortDir = $dir;

        return $this;
    }
}
