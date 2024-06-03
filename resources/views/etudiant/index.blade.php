@extends('welcome', ['titre' => 'Liste des étudiants'])

@section('contenu')
    <div class="container">
      <div class="table-response">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Nom</th>
              <th scope="col">Prénom</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($etudiants as $etudiant)
            <tr>
              <td>{{ $etudiant->nom  }}</td>
              <td>{{ $etudiant->prenom  }}</td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection