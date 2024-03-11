<!DOCTYPE html>
<html lang="en">

<head>

  @include('backend.layouts.head')

</head>

<body>
  
  <div class="container-fluid">

    <div class="row" style="margin-top:10%">
        <!-- Texto de Error 404 -->
      <div class="col-md-12">
        <div class="text-center">
          <div class="error mx-auto" data-text="404">404</div>
          <p class="lead text-gray-800 mb-5">Página no encontrada</p>
          <p class="text-gray-500 mb-0">Parece que encontraste un error en la matriz...</p>
          {{-- {{dd(auth()->user())}}; --}}
            <a href="{{route('home')}}">&larr; Volver a la página de inicio</a>
        </div>
      </div>
    </div>

    </div>

    @include('backend.layouts.footer')

</body>

</html>
