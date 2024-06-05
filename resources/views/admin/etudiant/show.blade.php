@extends('base')

@section('titre', $etudiant->nom. ' '.$etudiant->prenom)

@section('contenu')
    <div class="container">
      <div class="card">
        <div class="card-title">
          <h2>@yield('titre')</h2>  
        </div>  
      </div>  
    </div>
@endsection