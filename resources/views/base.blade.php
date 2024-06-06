<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titre') | Administration</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- CDN Bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

        {{-- Style --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
        <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}"/>
        <style>
            @layer reset{
              button{
                all: unset;
              }
            }
          </style>
    </head>
    <body>

       @yield('contenu')
       <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
       integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
      <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
      <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
      <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
      <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
      <script src="{{ asset('assets/js/vfsfonts.js') }}"></script>
      <script src="{{ asset('assets/js/main.js') }}"></script> 
      </body>
</html>
