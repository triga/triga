<?php namespace Source\DataGrid\View;

use Source\DataGrid\Url;
use Source\DataGrid\View\Partial\Grid;
use Source\DataGrid\View\Partial\Pagination;
use Source\DataGrid\View\Partial\Filter;

/**
 * DataGrid view builder.
 *
 * @package Source\DataGrid\View
 */
class Builder
{

    /**
     * Partial types.
     */
    const TYPE_GRID = 'grid';
    const TYPE_PAGINATION = 'pagination';
    const TYPE_FILTER = 'filter';

    /**
     * @var array View data to be passed to partial builders.
     */
    protected $data = [];

    /**
     * @var Url URL helper.
     */
    private $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    /**
     * Sets data for the Grid partial builder.
     *
     * @param array $data
     * @return $this
     */
    public function setDataForGrid(array $data = null)
    {
        $this->setViewData(self::TYPE_GRID, $data);

        return $this;
    }

    /**
     * Sets data for the Pagination partial builder.
     *
     * @param array $data
     * @return $this
     */
    public function setDataForPagination(array $data = null)
    {
        $this->setViewData(self::TYPE_PAGINATION, $data);

        return $this;
    }

    /**
     * Sets data for the Filter partial builder.
     *
     * @param array $data
     * @return $this
     */
    public function setDataForFilter(array $data = null)
    {
        $this->setViewData(self::TYPE_FILTER, $data);

        return $this;
    }

    /**
     * Sets view data for a specific partial.
     *
     * @param string $viewType
     * @param array $data
     */
    protected function setViewData($viewType, array $data = null)
    {
        $this->data[$viewType] = $data;
    }

    /**
     * Builds all the views and wraps them with the main DataGrid view.
     *
     * @return mixed
     */
    public function build()
    {
        return \View::make('data_grid.data_grid', [
            self::TYPE_GRID => (new Grid($this->url))->build($this->data[self::TYPE_GRID]),
            self::TYPE_PAGINATION => (new Pagination)->build($this->data[self::TYPE_PAGINATION]),
            self::TYPE_FILTER => (new Filter)->build($this->data[self::TYPE_FILTER]),
        ]);
    }

}
