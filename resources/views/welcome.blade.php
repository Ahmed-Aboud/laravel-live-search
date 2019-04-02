<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>       
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Movie quotes</title>

        <meta name="description" content="Forgot Movie Name ? Remember Your Movie Name By quotes"/>
        <link rel="canonical" href="{{ url('/') }}"/>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
</head>
<body>
<header class="header">
  <a class="title" href="/">Movie Quotes</a>
    <form id="search" method="get" action="{{ url('/') }}" onsubmit="return false;">
    <input type="search" id="search-input" name="search" value="{{ Request::get('search') }}" placeholder="Search your Movie by Quote">       
    </form>

</header>
<div class="main-warpper">
  <div class="demo-ribbon banner"></div>
  <div class="row">

    <div class="col-2 col-s-2 menu"></div>
    <main class="col-8 col-s-8">
      <article id="main-info" class="col- main" @if(!empty($results) && count($results) > 0 ) hidden= @endif >
        <h1>Search Movie by Quotes</h1>
        <h4>TNTSearch is a fully featured full text search engine written in PHP</h4>
        <p>this is just a demo for full text-search with laravel scout and TNTSearch Engine
            <br> all data used here are from <a href="https://www.springfieldspringfield.co.uk/movie_scripts.php">Springfield! Springfield!</a>
            <br> "the memes i collected them though"
        </p>
      </article>   
    </main>
  <div class="col-2 col-s-2"></div>
  </div>
</div>

<footer class="footer">
  <p>made with ❤️ by <a id="creator" target="_blank" rel="noreferrer" href="https://github.com/Ahmed-Aboud">Ahmed Aboud</a> </p>
<script type="text/javascript" src="{{ asset('js/app.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#search').on('keyup', function (e) {
        e.preventDefault();
        var search = $('#search-input').val();
        $.ajax({
            type: "GET",
            url: "{{ url('/') }}",
            data: { 
            'search' : search, 
            },
            success: function( data ) {
                 $('.movie').remove();
                 $('#main-info').hide();
                 $.each(data.results, function (key, result) {
                        trHTML = "<article class='col- main movie'><h4>" + result.name + "</h4></article>";

                 $('#main-info').after(trHTML);
                });
            }
        });
    });

});
</script>
</footer>
</body>
</html>