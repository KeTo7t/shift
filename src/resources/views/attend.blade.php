<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <title>打刻画面</title>

        <link rel="stylesheet" href="css/app.css"/>
        <script type="text/javascript">
            window.Laravel = window.Laravel || {};
            window.Laravel.csrfToken = "{{csrf_token()}}";
        </script>
    </head>


    <body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <p class="navbar-brand">  勤怠入力</p>
         <a class="btn btn-outline-primary" href="/logout">ログアウトする</a></nav>
    <div id="app">

        <attend-form></attend-form>
        <hr>
        <time-list></time-list>
    </div>
    <script src="js/app.js"></script>

    </body>
</html>
