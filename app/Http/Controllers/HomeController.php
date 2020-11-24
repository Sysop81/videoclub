<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
<<<<<<< HEAD
    public function getHome()
    {
    	return redirect()->action('App\Http\Controllers\CatalogController@getIndex');
    }

=======
    public function getHome(){
    	return redirect()->action('App\Http\Controllers\CatalogController@getIndex');
    }
>>>>>>> ej2
}
