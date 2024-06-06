@extends('base')

@section('titre', 'Liste des étudiants')

@section('contenu')

    <div class="container">
      
      <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('titre')</h1>
        <a href="{{ route('admin.etudiant.create') }}" type="button" class="btn btn-success">New Etudiant</a>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="data_table">
            <table id="dataTables" class="table table-striped table-bordered">
              <thead class="table-dark">
                <tr>
                  <th scope="col">Nom</th>
                  <th scope="col">Prénom</th>
                  <th scope="col">Genre</th>
                  <th scope="col" class="text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($etudiants as $etudiant)
                <tr>
                  <td>{{ $etudiant->nom  }}</td>
                  <td>{{ $etudiant->prenom  }}</td>
                  <td>{{ $etudiant->genre  }}</td>
                  <td class="text-right">
                    <a href="{{ route('admin.etudiant.show', ['etudiant' => $etudiant->objectId]) }}" type="button" class="text-secondary fs-5"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.etudiant.edit', ['etudiant' => $etudiant->objectId]) }}" type="button" class="text-primary fs-5"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.etudiant.destroy', ['etudiant' => $etudiant->objectId]) }}" method="post" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-danger fs-5 delete-button"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection