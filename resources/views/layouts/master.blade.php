<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .add {
            font-size: 30px;
            font-weight: 800;
        }

        .new-btn {
            background: white;
            display: inline-block;
            position: relative;
            border: 1px solid #8C8C8CFF;
            border-radius: 10px;
            float: left;
            padding: 35px;
            margin-top: 20px;
        }

        .compound {
            display: inline-block;
            background: white;
            border: 1px solid #494949FF;
            border-radius: 10px;
            margin: 12px;
            overflow: hidden;
            text-align: center;
        }

        span.label {
            display: block;
            text-align: center;
            color: black;
            font-family: arial;
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 5px;
        }

    </style>

</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
