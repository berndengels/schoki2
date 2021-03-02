<!doctype html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <!--link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/pdf.css') }}" />
    @yield('extra-headers')
</head>
<body>
    @yield('content')
</body>
</html>
