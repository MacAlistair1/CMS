<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
        <title>{{config('app.name', 'Blog Post')}}</title>
    </head>
    <body>
     @include('includes.navbar')
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>
    @include('includes.footer')
</body>
</html>
