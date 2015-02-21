<?php namespace Triga\Http\Controllers;

use Illuminate\View\Factory as ViewFactory;

class AppController extends Controller {

    protected $layout = '_layouts.base';

    /**
     * @var ViewFactory
     */
    protected $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    protected function render(){
        return $this->view->make($this->layout);
    }

}
