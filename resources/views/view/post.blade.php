<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{{ url('css/font.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('bower_components/jquery-confirm2/dist/jquery-confirm.min.css') }}" />
    <style>
        .page-item {
            list-style: none;
            display: inline-block;
            padding: 10px;
        }

        a {
            text-decoration: none;
        }

        .jconfirm .jconfirm-holder {
            max-height: 100%;
            padding: 50px 0;
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <header class="header">
                <a href="/">
                    {{ $name }}
                </a>
                <nav class="nav">
                    <div class="flash -notice">
                        Signed in successfully.
                    </div>

                    <nav class="nav">
                        @foreach($pages as $page)
                        <a class="nav_item" aria-current="page" href="/page/{{ $page->slug }}">{{ $page->title }}</a>
                        @endforeach
                    </nav>
            </header>

            <div class="container max-eight padding-bottom-gigantic">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->time }}</p>
                <p>@markdown($post->text)</p>
            </div>

            <footer class="text-center text-tiny text-light padding-top-huge padding-bottom-bigger">
                powered by <a href="https://github.com/singleblog/singleblog" class="text-decoration-none">singleblog</a>
                <br>
            </footer>
        </div>
    </div>


    <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('bower_components/jquery-confirm2/dist/jquery-confirm.min.js') }}"></script>
</body>

</html>
