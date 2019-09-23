<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ログイン画面</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <a href="{{ url('login/google') }}" class="btn btn-danger"><i class="fa fa-google-plus"></i> Google+ でログインする</a>
    </body>
</html>
