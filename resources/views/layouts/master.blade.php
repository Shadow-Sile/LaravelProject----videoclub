<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>

  
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
   

   @include('partials.navbar')

    <div class="container"> @yield('content') </div>
<style>
.movie-card {
    position: relative;
    overflow: hidden;
    border-radius: 0.5rem;           /* borde redondeado Bootstrap-style */
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.movie-card:hover {
    transform: scale(1.05);          /* zoom suave */
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    z-index: 10;
}

/* Caja con la info del show.blade que aparece al pasar el ratón */
.movie-info-hover {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 0.75rem;
    background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
    color: #fff;
    max-height: 70%;                 /* para que no tape todo el póster */
    overflow: hidden;
    opacity: 0;
    transition: opacity 0.2s ease;
    text-align: left;
    font-size: 0.85rem;
}

.movie-card:hover .movie-info-hover {
    opacity: 1;
}
</style>


  </body>
</html>