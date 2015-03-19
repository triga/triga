<?php namespace Source\DataGrid;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

class DataGrid
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Builder
     */
    private $query;

    private $perPage = 20;

    public function __construct(Request $request)
    {
        ;
        $this->request = $request;
    }

    public function make(Builder $query)
    {
        $this->query = $query;

        $queryBuilder = (new QueryBuilder($this->query))->setSortingColumn($this->request->get('order_by'))
            ->setSortingDirection($this->request->get('order_dir'))
            ->setOffset($this->request->get('page'), $this->perPage)
            ->setLimit($this->perPage);

        $query = $queryBuilder->getQuery();
        var_dump($query->toSql());
        die;
    }
}
