<?php
class IndexController
{
	
	public function index($service){
		extract($service);

		return $view->make('welcome', ['request' => $request]);
	}
}