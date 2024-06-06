@extends('base')

@section('titre', $autorisation ? "Modifier un étudiant" : "Créer un étudiant")

@section('contenu')
 <div class="container mt-5">
  <div class="card p-3">
    <div class="card-title">
      <h1 class="text-center">@yield('titre')</h1>
    </div>
    <div class="card-body">
      <form action="{{ route($autorisation ? 'admin.etudiant.update' : 'admin.etudiant.store', $id_etudiant ?? 0)  }}" enctype="multipart/form-data" method="post" class="vstack gap-2">
        @csrf
        @method($autorisation ? 'PUT' : 'POST')
        <div class="form-group">
          <label for="image">image</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*"/>
        </div>
        @include('widget.input', ['class' => 'col', 'label' => 'Nom', 'name' => 'nom', 'valeur' => $etudiant->nom])
        @include('widget.input', ['class' => 'col', 'label' => 'Prénom', 'name' => 'prenom', 'valeur' => $etudiant->prenom])

       <div class="row">
        <div class="form-group col mt-2">
          <label class="label-form" for="genre">Genre</label>
          <select name="genre" id="genre" class="form-control">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
            <option value="Autres">Autres</option>
          </select>
        </div>
       </div>
       <div class="form-group mt-2">
          <button class="btn btn-primary">
            @if($autorisation)
              Modifier
            @else
              Créer
            @endif
          </button>
        </div>
      </form>
    </div>
  </div>
 </div>
@endsection