<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  <title>FashionablyLate</title>
@yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header__space"></div>
      <a class="header__logo">
        FashionablyLate
      </a>
      <div class="header__button">
        @yield('header-button')
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>
</html>