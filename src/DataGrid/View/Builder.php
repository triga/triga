<?php namespace Source\DataGrid\View;

use Source\DataGrid\View\Partial\Grid;

/**
 * DataGrid view builder.
 *
 * @package Source\DataGrid\View
 */
class Builder {

    /**
     * Partial types.
     */
    const TYPE_GRID = 'grid';

    /**
     * @var array View data to be passed to partial builders.
     */
    protected $data = [];

    /**
     * Sets data for the Grid partial builder.
     *
     * @param array $data
     * @return $this
     */
    public function setDataForGrid(array $data = null){
        $this->setViewData(self::TYPE_GRID, $data);

        return $this;
    }

    /**
     * Sets view data for a specific partial.
     *
     * @param string $viewType
     * @param array $data
     */
    protected function setViewData($viewType, array $data = null){
        $this->data[$viewType] = $data;
    }

    /**
     * Builds all the views and wraps them with the main DataGrid view.
     *
     * @return mixed
     */
    public function build(){
        return \View::make('data_grid.data_grid', [
            self::TYPE_GRID => (new Grid)->build($this->data[self::TYPE_GRID]),
        ]);
    }

}
