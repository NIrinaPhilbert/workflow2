<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
    </head>
    <body>
    <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Accueilc</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="entity">Entité</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tool">Outil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="client">Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="type demande">Type demande</a>
          </li>
        </ul>
        @if(session()->has('message_info'))
        <div class="alert alert-success" role="alert">
          {{ session()->get('message_info') }}
        </div>
        @endif
        @yield('content')    
    </div>       
    </body>
</html>
