<?php namespace Source\DataGrid;

use Illuminate\Http\Request;

/**
 * URL helper allowing to build links easier.
 *
 * @package Source\DataGrid
 */
class Url
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @var array Registered filters.
     */
    private $filters;

    /**
     * @param Request $request
     * @param array $filters
     */
    public function __construct(Request $request, array $filters = null)
    {
        $this->request = $request;
        $this->filters = $filters;
    }

    /**
     * Returns the page URL with changed sorting params.
     *
     * @param string $orderBy
     * @param string $orderDir
     * @return string
     */
    public function getWithOrder($orderBy, $orderDir){
        $query = http_build_query(array_merge(
            $this->filters,
            ['order_by' => $orderBy, 'order_dir' => $orderDir],
            ['limit' => $this->request->get('limit'), 'page' => $this->request->get('page')]
        ));

        return $this->request->url().'/?'.$query;
    }

}
