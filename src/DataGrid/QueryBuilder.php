<?php namespace Source\DataGrid;

class QueryBuilder
{

    /**
     * @var array
     */
    private $columns;
    private $table;

    public function __construct(array $columns, $table)
    {
        $this->columns = $columns;
        $this->table = $table;
    }

    public function getQuery()
    {
        return sprintf('SELECT %s FROM %s', join(',', $this->columns), $this->table);
    }
}
