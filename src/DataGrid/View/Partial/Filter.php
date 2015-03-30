<?php namespace Source\DataGrid\View\Partial;

/**
 * Partial view builder.
 *
 * @package Source\DataGrid\View\Partial
 */
class Filter {

    /**
     * Builds the view.
     *
     * @param array $data
     * @return mixed
     */
    public function build(array $data){
        return \View::make($data['filename']);
    }

}
