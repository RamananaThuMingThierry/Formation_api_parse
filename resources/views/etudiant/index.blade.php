@extends('welcome', ['titre' => 'Liste des étudiants'])

@section('contenu')
    <div class="container">
      <div class="table-response">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Nom</th>
              <th scope="col">Prénom</th>
              <th scope="col">Promotion</th>
              <th scope="col">Genre</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($etudiants as $etudiant)
            <tr>
              <th scope="row">{{ $etudiant->nom }}</th>
              <td>{{ $etudiant->prenom }}</td>
              <td>{{ $etudiant->promotion  }}</td>
              <td>{{ $etudiant->genre }}</td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection