<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy"
          content="default-src * data: blob: 'self' 'unsafe-inline';script-src * data: blob: 'self' 'inline' 'unsafe-inline' 'unsafe-eval';img-src * 'self' data:"/>

    {{-- TODO translatable suffix --}}
    <title>@yield('title', 'Craftable') - {{ trans('brackets/admin-ui::admin.page_title_suffix') }}</title>
	@include('admin.partials.main-styles')
    @include('admin.partials.favicon')
    @yield('styles')
</head>
<body class="app header-fixed sidebar-fixed sidebar-lg-show">

    @yield('header')
    @yield('content')
    @yield('footer')

    @include('admin.partials.wysiwyg-svgs')
    @include('admin.partials.main-bottom-scripts')
    @yield('bottom-scripts')
</body>
</html>
