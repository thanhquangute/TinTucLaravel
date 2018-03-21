<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Laravel Khoa Pham</title>
    <base href={{asset('')}}/>
    <link href="layout/css/bootstrap.min.css" rel="stylesheet">
    <link href="layout/css/shop-homepage.css" rel="stylesheet">
    <link href="layout/css/my.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    @include('layout.header')
    <!-- Page Content -->
    @yield('content')
    <!-- end Page Content -->

    <!-- Footer -->
    <hr>
   @include('layout.footer')
    <!-- end Footer -->
    <!-- jQuery -->
    <script src="layout/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="layout/js/bootstrap.min.js"></script>
    <script src="layout/js/my.js"></script>
    @yield('script')
</body>

</html>
