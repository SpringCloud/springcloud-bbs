<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $forum->attributes->description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta name="theme-color" content="{{ $forum->attributes->themePrimaryColor }}">
    @foreach ($styles as $file)
      <link rel="stylesheet" href="{{ $forum->attributes->baseUrl . str_replace(public_path(), '', $file) }}">
    @endforeach

    {!! $head !!}
      <!--  百度统计    -->
      <script>
          var _hmt = _hmt || [];
          (function() {
              var hm = document.createElement("script");
              hm.src = "//hm.baidu.com/hm.js?f0c6f98cef354b2460d63b4e7889c1d7";
              var s = document.getElementsByTagName("script")[0];
              s.parentNode.insertBefore(hm, s);
          })();
      </script>
      <!--  Google Analytics    -->
      <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-83645028-2', 'auto');
          ga('send', 'pageview');
      </script>

      <link rel="apple-touch-icon" href="assets/image/icon.png">
      <link rel="icon" type="image/png" href="assets/image/icon.png">
      <link rel="shortcut icon" type="image/x-icon" href="assets/image/favicon.ico">
      <link rel="bookmark" type="image/x-icon" href="assets/image/favicon.ico">
  </head>

  <body>
    {!! $layout !!}

    <div id="modal"></div>
    <div id="alerts"></div>

    @if (! $noJs)
      <script>
        document.getElementById('flarum-loading').style.display = 'block';
      </script>

      @foreach ($scripts as $file)
        <script src="{{ $forum->attributes->baseUrl . str_replace(public_path(), '', $file) }}"></script>
      @endforeach

      <script>
        document.getElementById('flarum-loading').style.display = 'none';
        @if (! $forum->attributes->debug)
        try {
        @endif
          var app = System.get('flarum/app').default;

          babelHelpers._extends(app, {!! json_encode($app) !!});

          @foreach ($bootstrappers as $bootstrapper)
            System.get('{{ $bootstrapper }}');
          @endforeach

          app.boot();
        @if (! $forum->attributes->debug)
        } catch (e) {
          var nojs = window.location.search ? '&nojs=1' : '?nojs=1';
          window.location = window.location + nojs;
        }
        @endif
      </script>
    @endif

    {!! $foot !!}
  </body>
</html>
