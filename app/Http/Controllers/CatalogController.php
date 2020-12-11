<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{
    public function getIndex()
    {
		return view('catalog.index', array('arrayPeliculas' => Movie::all()));
    }

    public function getShow($id)
    {
    	return view('catalog.show',
    		array(
    			'pelicula' => Movie::findOrFail($id)
    		)
    	);
    }

    public function getCreate()
    {
    	return view('catalog.create');
    }

    public function getEdit($id)
    {
    	return view('catalog.edit', array('pelicula' => Movie::findOrFail($id)));
    }

    public function putEdit(Request $request){
        $id = $request->input('id');
        $pelicula = Movie::findOrFail($id); //la recuperamos a traves del modelo pasando el id

        //Modificamos con los datos del formulario
        $pelicula->title = $request->input('title');
		$pelicula->year = $request->input('year');
		$pelicula->director = $request->input('director');
		$pelicula->poster = $request->input('poster');
		$pelicula->synopsis = $request->input('synopsis');
        $pelicula->save();
        //Redirigimos al show
        return redirect('/catalog/show/'.$id);
    }

    public function postCreate(Request $request){
        $pelicula = new Movie();
        $pelicula->title = $request->input('title');
		$pelicula->year = $request->input('year');
		$pelicula->director = $request->input('director');
		$pelicula->poster = $request->input('poster');
		$pelicula->synopsis = $request->input('synopsis');
		$pelicula->save();
        return redirect('/catalog');
    }



}
