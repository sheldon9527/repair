<head>
    <meta charset="UTF-8">
    <title>@yield('title', '西安思源学院 Admin')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.2 -->
    <link href="/bower/AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bower/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/bower/Ionicons/css/ionicons.min.css">
    <!-- style.min.css -->
    <link rel="stylesheet" href="/css/style.min.css">
    <!-- Theme style -->
    <link href="/bower/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- morris.css -->
    <link rel="stylesheet" href="/bower/AdminLTE/plugins/morris/morris.css">

    <link rel="stylesheet" href="/bower/bootstrap-select/dist/css/bootstrap-select.min.css">

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="/bower/AdminLTE/dist/css/skins/skin-red-light.min.css" rel="stylesheet" type="text/css" />

    <!-- Datepicker -->
    <link href="/bower/AdminLTE/plugins/datepicker/datepicker3.css" rel="stylesheet" />

    <!-- Datetimepicker -->
    <link rel="stylesheet" href="/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <link href='/bower/dropzone/dist/min/basic.min.css' rel="stylesheet" />

    {{-- rich text --}}
    <link href="/bower/google-code-prettify/src/prettify.css" rel="stylesheet" />
    <link href='/bower/bootstrap-wysiwyg/css/style.css' rel="stylesheet" />

    <link href='/bower/bootstrap-tagsinput/dist/bootstrap-tagsinput.css' rel="stylesheet" />
    <link href='/bower/bootstrap-tagsinput/dist/bootstrap-tagsinput-typeahead.css' rel="stylesheet" />

    <link href='/css/admin.css' rel="stylesheet" />


    {{-- requrejs --}}

    <script src="/bower/requirejs/require.js"></script>
    <script src="/js/admin.js"></script>
</head>
