<?php namespace Triga\Http\Controllers;

use Source\DataGrid\DataGrid;
use Triga\Http\Requests;

class UserController extends AppController {

    /**
     * @param DataGrid $dataGrid
     * @return Response
     */
	public function getIndex(DataGrid $dataGrid)
	{
        $query = \DB::table('users')
            ->select('email', 'id');

        $dataGrid->query($query);

        $dataGrid->filter('email', function($query, $value) {
            $query->where('email', '=', $value);
        });

        $dataGrid->useFilterView('user.data_grid.filter');

        return $this->render([
            'middle' => $dataGrid->make(),
        ]);
	}

}
