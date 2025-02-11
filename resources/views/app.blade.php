<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- CRSF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/js/app.js', 'resources/sass/app.scss')
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>
