<?php namespace Source\DataGrid;

use Illuminate\Http\Request;

class DataGrid
{

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        ;
        $this->request = $request;
    }

    public function make(array $columns, $table)
    {
        var_dump($this->request->get('foo'));
        $queryBuilder = new QueryBuilder($columns, $table);

        $query = $queryBuilder->getQuery();
        var_dump($query);
        die;
    }
}
