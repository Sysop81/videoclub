<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use App\Http\Resources\PeliculaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PeliculaResource::collection(Pelicula::paginate());
    }

    /**
     * Display a listing of the resource.
     *
     * @param  String  $search
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {
        $host = 'www.omdbapi.com';
        $response = Http::get('http://' . $host . '/', [
            'apikey' => env('OMDBAPI_KEY'),
            's' => $search,
            'page' => 1,
            'r' => 'json'
        ]);
        return response()->json(json_decode($response));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pelicula = json_decode($request->getContent(), true);

        $pelicula = Pelicula::create($pelicula);

        return new PeliculaResource($pelicula);
    }

    public function storeOMDB($idFilm){

        $host = 'www.omdbapi.com';
        $response = Http::get('http://' . $host . '/', [
            'apikey' => env('OMDBAPI_KEY'),
            'i' => $idFilm,  //Cambiamos el parametro s por i y le establecemos el valor del identificador pasado como parametro
            'page' => 1,
            'r' => 'json'
        ]);

        //return response()->json(json_decode($response));

        //Instanciamos la pelicula mediante los valores obtenidos OMDB y la guardamos en la BBDD
        $p = new Pelicula;
		$p->title = $response['Title'];
		//$p->year = $response['Year'];       //Anulado debido a que por ejemplo con juego de tronos llega un rango de años
		$p->director = $response['Director'];
		$p->poster = $response['Poster'];
        $p->rented = false;
		$p->synopsis = $response['Plot'];
		$p->save();

        //Devolvemos la respuesta al usuario del nuevo recurso almacenado instanciando un objeto de la clase peliculaResource
        $peliculaResource = new PeliculaResource($p);

        return $peliculaResource;

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(Pelicula $pelicula)
    {
        return new PeliculaResource($pelicula);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        $peliculaData = json_decode($request->getContent(), true);
        $pelicula->update($peliculaData);

        return new PeliculaResource($pelicula);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
    }
}
