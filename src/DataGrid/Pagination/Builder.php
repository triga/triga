<?php namespace Source\DataGrid\Pagination;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Source\DataGrid\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;

/**
 * DataGrid pagination builder.
 *
 * @package Source\DataGrid\Pagination
 */
class Builder
{

    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Builds thee pagination, but does not render it.
     *
     * @param QueryBuilder $queryBuilder
     * @return $this
     */
    public function build(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        $this->paginator = new Paginator($queryBuilder->getResults(), $queryBuilder->getTotalResultCount(), $queryBuilder->getLimit(), $this->request->get('page'));

        return $this;
    }

    /**
     * Renders the pagination view and returns the result.
     *
     * @return string
     */
    public function render()
    {
        $this->setPath();

        return $this->paginator->render();
    }

    /**
     * Sets the pagination link URL's and appends filter data.
     */
    protected function setPath()
    {
        // We need to get the filter, sorting and pagination from the request object (nothing more)
        $input = array_merge(array_keys($this->queryBuilder->getFilters()), array('limit', 'order_by', 'order_dir'));

        $this->paginator->setPath($this->request->url());
        $this->paginator->appends(array_filter($this->request->only($input)));
    }

}
