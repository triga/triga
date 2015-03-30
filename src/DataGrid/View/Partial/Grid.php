<?php namespace Source\DataGrid\View\Partial;

use Source\DataGrid\Url;

/**
 * Partial view builder.
 *
 * @package Source\DataGrid\View\Partial
 */
class Grid
{

    /**
     * @var Url URL helper.
     */
    private $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    /**
     * Builds the view.
     *
     * @param array $data
     * @return mixed
     */
    public function build(array $data)
    {
        return \View::make('data_grid.grid.grid', array_merge($data, [
            'order' => $this->getOrderUrls($data['columns']),
            'order_by' => $this->url->getOrderBy(),
            'order_dir' => $this->url->getOrderDir(),
        ]));
    }

    /**
     * Returns URLs used to sort the results.
     *
     * @param array $columns
     * @return array
     */
    protected function getOrderUrls($columns)
    {
        $order_urls = [];

        foreach ($columns as $column) {
            $order_urls[$column] = [
                'asc' => $this->url->getWithOrder($column, 'asc'),
                'desc' => $this->url->getWithOrder($column, 'desc'),
            ];
        }

        return $order_urls;
    }

}
