@extends('welcome', ['titre' => 'Liste des étudiants'])

@section('contenu')
    <div class="container">
      <div class="table-response">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Messages</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
              <td>{{ $post->title }}</td>
              <td>{{ $post->content  }}</td>
              @if(isset($commentsByPostId[$post->getObjectId()]))
                  <ul>
                      @foreach ($commentsByPostId[$post->getObjectId()] as $comment)
                          <li>Comment ID: {{ $comment->getObjectId() }} - Content: {{ $comment->get("content") }}</li>
                      @endforeach
                  </ul>
              @endif
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection