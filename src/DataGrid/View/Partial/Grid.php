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
        $order_urls = [];

        foreach ($data['columns'] as $column) {
            $order_urls[$column] = [
                'asc' => $this->url->getWithOrder($column, 'asc'),
                'desc' => $this->url->getWithOrder($column, 'desc'),
            ];
        }

        return \View::make('data_grid.grid.grid', array_merge($data, array('order' => $order_urls)));
    }

}
