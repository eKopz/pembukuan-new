<!DOCTYPE html>
<html lang="en" class="h-100" id="login-page1">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/ekopz-icon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">
    @yield('content')
    <!-- #/ container -->
    <!-- Common JS -->
    <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>
    <!-- Custom script -->
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/gleek.js') }}"></script>

    <!-- view image before upload -->
    <script type="text/javascript">
      function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function()
        {
          var output = document.getElementById('output_image');
          output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>
</body>

</html>
