<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ユーザー登録画面</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <!-- Styles -->
        <style>

        </style>
        <script type="text/javascript">
            window.Laravel = window.Laravel || {};
            window.Laravel.csrfToken = "{{csrf_token()}}";
        </script>
    </head>
    <body>
    <form action="/login/regist" method="post">
    <p>ユーザー名：　<input type="text" name="name" value="{{$name}}"></p>
    <p>メールアドレス：　{{$email}} </p>
        <input type="hidden" name="email" value="{{$email}}">
        {{ csrf_field() }}
<input type="submit">
    　　　</form>

    </body>
</html>
