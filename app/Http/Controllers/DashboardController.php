<?php namespace Triga\Http\Controllers;

use Triga\Http\Requests;

use Illuminate\Http\Request;

class DashboardController extends AppController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->render();
    }

}
