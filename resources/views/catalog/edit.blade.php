@extends('layouts.master')

@section('content')

    Modificar pelicula 

     <div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Modificar película
         </div>
         <div class="card-body" style="padding:30px">

            <form action="{{ url('/catalog/edit') }}" method="POST">
            	{{method_field('PUT')}}
            	@csrf
            	
            </form>

            <div class="form-group">
               <label for="title">Título</label>
               <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
            	<label for="year">Año</label><br>
               <input type="number" name="year" id="year">
            </div>

            <div class="form-group">
            	<label for="director">Director</label><br>
               <input type="text" name="director" id="director">
            </div>

            <div class="form-group">
            	<label for="poster">Poster</label><br>
               <input type="text" name="poster" id="poster">
            </div>

            <div class="form-group">
               <label for="synopsis">Resumen</label>
               <textarea name="synopsis" id="synopsis" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   	<main>Modificar</main> película
               </button>
            </div>

            {{-- TODO: Cerrar formulario --}}

         </div>
      </div>
   </div>
</div>

@stop