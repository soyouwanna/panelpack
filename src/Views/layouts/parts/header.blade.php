<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('meta_title') {{ $site_settings['site_name'] }} - {{ $site_settings['city'] }}</title>
    <meta name="description" content="@yield('meta_description',$site_settings['meta_description'])">
    <meta name="keywords" content="@yield('meta_keywords',$site_settings['meta_keywords'])">
    @include('vendor.decoweb.layouts.meta.og')

    @yield('header-assets')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>